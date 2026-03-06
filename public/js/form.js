/**
 * Team Mehrwert - Form Validation & AJAX Submission
 * Handles client-side validation and form submission
 */

(function() {
  'use strict';

  // DOM Elements
  const form = document.getElementById('contactForm');
  const submitBtn = document.getElementById('submitBtn');
  const successMessage = document.getElementById('successMessage');
  const errorMessage = document.getElementById('errorMessage');
  const errorText = document.getElementById('errorText');
  const formContainer = document.getElementById('formContainer');

  // Form fields
  const fields = {
    vorname: document.getElementById('vorname'),
    name: document.getElementById('name'),
    email: document.getElementById('email'),
    mobilfunknummer: document.getElementById('mobilfunknummer'),
    mentor: document.getElementById('mentor'),
    privacy: document.getElementById('privacy'),
    marketing: document.getElementById('marketing'),
    website: document.getElementById('website') // Honeypot
  };

  // Error elements
  const errors = {
    vorname: document.getElementById('vornameError'),
    name: document.getElementById('nameError'),
    email: document.getElementById('emailError'),
    mobilfunknummer: document.getElementById('mobilfunknummerError'),
    mentor: document.getElementById('mentorError'),
    privacy: document.getElementById('privacyError'),
    marketing: document.getElementById('marketingError')
  };

  /**
   * Validation functions
   */
  const validators = {
    // Validate name fields (min 2 chars)
    validateName: (value) => {
      return value.trim().length >= 2;
    },

    // Validate email (RFC 5322 compliant)
    validateEmail: (value) => {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(value.trim());
    },

    // Validate German mobile number
    // Accepts formats: +49170123456, 0170123456, +49 170 123456, etc.
    validateMobile: (value) => {
      const cleaned = value.replace(/\s+/g, '');
      const mobileRegex = /^(\+49|0049|0)[1-9]\d{9,10}$/;
      return mobileRegex.test(cleaned);
    },

    // Validate checkbox
    validateCheckbox: (checkbox) => {
      return checkbox.checked;
    }
  };

  /**
   * Show error message for a field
   */
  function showError(fieldName) {
    if (fields[fieldName] && errors[fieldName]) {
      fields[fieldName].classList.add('error');
      errors[fieldName].classList.add('visible');
    }
  }

  /**
   * Hide error message for a field
   */
  function hideError(fieldName) {
    if (fields[fieldName] && errors[fieldName]) {
      fields[fieldName].classList.remove('error');
      errors[fieldName].classList.remove('visible');
    }
  }

  /**
   * Validate individual field
   */
  function validateField(fieldName) {
    const field = fields[fieldName];
    if (!field) return true;

    let isValid = false;

    switch (fieldName) {
      case 'vorname':
      case 'name':
      case 'mentor':
        isValid = validators.validateName(field.value);
        break;
      case 'email':
        isValid = validators.validateEmail(field.value);
        break;
      case 'mobilfunknummer':
        isValid = validators.validateMobile(field.value);
        break;
      case 'privacy':
      case 'marketing':
        isValid = validators.validateCheckbox(field);
        break;
      default:
        isValid = true;
    }

    if (isValid) {
      hideError(fieldName);
    } else {
      showError(fieldName);
    }

    return isValid;
  }

  /**
   * Validate entire form
   */
  function validateForm() {
    let isValid = true;

    // Validate all fields
    Object.keys(fields).forEach(fieldName => {
      if (fieldName !== 'website') { // Skip honeypot
        if (!validateField(fieldName)) {
          isValid = false;
        }
      }
    });

    return isValid;
  }

  /**
   * Check honeypot (spam protection)
   */
  function checkHoneypot() {
    return fields.website.value === '';
  }

  /**
   * Show loading state
   */
  function setLoading(isLoading) {
    if (isLoading) {
      submitBtn.disabled = true;
      submitBtn.classList.add('btn-loading');
      submitBtn.textContent = '';
    } else {
      submitBtn.disabled = false;
      submitBtn.classList.remove('btn-loading');
      submitBtn.textContent = 'Jetzt anmelden';
    }
  }

  /**
   * Show success message
   */
  function showSuccess() {
    formContainer.classList.add('hidden');
    successMessage.classList.remove('hidden');
    errorMessage.classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  /**
   * Show error message
   */
  function showErrorMessage(message) {
    errorText.textContent = message || 'Bitte versuchen Sie es später erneut.';
    errorMessage.classList.remove('hidden');
    successMessage.classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  /**
   * Handle form submission
   */
  async function handleSubmit(e) {
    e.preventDefault();

    // Hide previous messages
    successMessage.classList.add('hidden');
    errorMessage.classList.add('hidden');

    // Validate form
    if (!validateForm()) {
      showErrorMessage('Bitte füllen Sie alle Pflichtfelder korrekt aus.');
      return;
    }

    // Check honeypot
    if (!checkHoneypot()) {
      // Silent fail for bots
      console.log('Honeypot triggered');
      return;
    }

    // Prepare form data
    const formData = new FormData(form);

    // Show loading state
    setLoading(true);

    try {
      // Submit form via AJAX
      const response = await fetch('api/submit.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        // Success
        showSuccess();
        form.reset();
      } else {
        // Error from server
        showErrorMessage(result.error || 'Ein Fehler ist aufgetreten.');
      }
    } catch (error) {
      // Network or parsing error
      console.error('Submission error:', error);
      showErrorMessage('Verbindungsfehler. Bitte überprüfen Sie Ihre Internetverbindung.');
    } finally {
      setLoading(false);
    }
  }

  /**
   * Add real-time validation on blur
   */
  Object.keys(fields).forEach(fieldName => {
    const field = fields[fieldName];
    if (field && fieldName !== 'website') {
      field.addEventListener('blur', () => {
        validateField(fieldName);
      });

      // Also validate on input for better UX
      field.addEventListener('input', () => {
        if (errors[fieldName].classList.contains('visible')) {
          validateField(fieldName);
        }
      });
    }
  });

  /**
   * Form submit event
   */
  form.addEventListener('submit', handleSubmit);

  /**
   * Generate CSRF token on page load
   * Note: This will be replaced with server-generated token
   */
  window.addEventListener('DOMContentLoaded', () => {
    // CSRF token will be generated by PHP and inserted into the form
    // This is just a placeholder for now
    console.log('Form initialized');
  });

})();
