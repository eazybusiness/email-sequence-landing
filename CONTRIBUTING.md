# Contributing Guidelines

Thank you for contributing to the Email Sequence Landing Page project!

---

## 📋 Table of Contents

1. [Code Style](#code-style)
2. [Git Workflow](#git-workflow)
3. [Commit Messages](#commit-messages)
4. [Testing Requirements](#testing-requirements)
5. [Documentation](#documentation)
6. [Pull Request Process](#pull-request-process)

---

## 🎨 Code Style

### PHP Code Style (PSR-12)

Follow [PSR-12 coding standard](https://www.php-fig.org/psr/psr-12/).

**Key Points:**
- Use 4 spaces for indentation (no tabs)
- Opening braces on same line for functions/classes
- Always use strict types: `declare(strict_types=1);`
- Use type hints for parameters and return types
- Use meaningful variable names

**Example:**
```php
<?php
declare(strict_types=1);

function validateEmail(string $email): bool
{
    if (empty($email)) {
        return false;
    }
    
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
```

### JavaScript Code Style (ES6+)

**Key Points:**
- Use 2 spaces for indentation
- Use semicolons
- Use `const` and `let`, avoid `var`
- Use arrow functions where appropriate
- Use template literals for strings

**Example:**
```javascript
const validateForm = (formData) => {
  const { name, email } = formData;
  
  if (!name || name.length < 2) {
    return { valid: false, error: 'Name too short' };
  }
  
  if (!isValidEmail(email)) {
    return { valid: false, error: 'Invalid email' };
  }
  
  return { valid: true };
};
```

### HTML Code Style

**Key Points:**
- Use 2 spaces for indentation
- Use semantic HTML5 elements
- Always close tags
- Use lowercase for tags and attributes
- Use double quotes for attributes

**Example:**
```html
<section class="contact-form">
  <h2 class="text-2xl font-bold">Contact Us</h2>
  <form id="contact-form" method="post">
    <input type="email" name="email" required />
    <button type="submit">Submit</button>
  </form>
</section>
```

### CSS Code Style

**Key Points:**
- Use 2 spaces for indentation
- Use BEM naming convention (optional)
- Group related properties
- Use TailwindCSS utility classes where possible

**Example:**
```css
/* Custom styles only when TailwindCSS is not sufficient */
.form-input {
  transition: all 0.3s ease;
}

.form-input:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}
```

---

## 🔄 Git Workflow

### Branch Naming

- `main` - Production-ready code
- `develop` - Development branch
- `feature/feature-name` - New features
- `fix/bug-name` - Bug fixes
- `docs/doc-name` - Documentation updates

### Workflow Steps

1. **Create a new branch**
   ```bash
   git checkout -b feature/form-validation
   ```

2. **Make changes and commit**
   ```bash
   git add .
   git commit -m "feat: add email validation"
   ```

3. **Push to repository**
   ```bash
   git push origin feature/form-validation
   ```

4. **Create pull request** (if using GitHub/GitLab)

5. **Merge after review**
   ```bash
   git checkout main
   git merge feature/form-validation
   git push origin main
   ```

---

## 💬 Commit Messages

Follow [Conventional Commits](https://www.conventionalcommits.org/) format.

### Format
```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, no logic change)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

### Examples

**Good:**
```
feat(form): add email validation to contact form

- Added client-side validation
- Added server-side validation
- Added error messages
```

```
fix(api): resolve CSRF token validation issue

The CSRF token was not being validated correctly due to
session timing out. Fixed by extending session lifetime.

Fixes #123
```

```
docs(readme): update installation instructions

Added section on IONOS deployment and Brevo setup.
```

**Bad:**
```
Update files
```

```
Fixed bug
```

```
WIP
```

---

## 🧪 Testing Requirements

### Before Committing

1. **Test locally**
   ```bash
   cd public
   php -S localhost:8000
   ```

2. **Test form validation**
   - Test with valid data
   - Test with invalid data
   - Test with empty fields
   - Test with special characters

3. **Test on mobile**
   - Test on iOS Safari
   - Test on Android Chrome

4. **Check for errors**
   - Check browser console
   - Check PHP error logs

### Unit Tests (Optional)

If adding PHP unit tests:
```bash
cd tests
php test_form.php
```

---

## 📚 Documentation

### Code Comments

**PHP:**
```php
/**
 * Validates email address using RFC 5322 standard
 * 
 * @param string $email Email address to validate
 * @return bool True if valid, false otherwise
 */
function validateEmail(string $email): bool
{
    // Use filter_var for RFC 5322 compliance
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
```

**JavaScript:**
```javascript
/**
 * Validates form data before submission
 * @param {Object} formData - Form data to validate
 * @returns {Object} Validation result with valid flag and error message
 */
const validateForm = (formData) => {
  // Validation logic here
};
```

### Updating Documentation

When making changes, update relevant documentation:

- **README.md** - For user-facing changes
- **PLANNING.md** - For architectural changes
- **TASK.md** - Mark tasks as complete
- **docs/** - For detailed guides

---

## 🔍 Pull Request Process

### Before Creating PR

1. ✅ All tests pass
2. ✅ Code follows style guidelines
3. ✅ Documentation updated
4. ✅ Commit messages follow convention
5. ✅ No merge conflicts

### PR Template

```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Documentation update
- [ ] Code refactoring

## Testing
- [ ] Tested locally
- [ ] Tested on mobile
- [ ] All tests pass

## Checklist
- [ ] Code follows style guidelines
- [ ] Documentation updated
- [ ] Commit messages follow convention
- [ ] No merge conflicts
```

### Review Process

1. Create pull request
2. Wait for code review
3. Address feedback
4. Get approval
5. Merge to main

---

## 🐛 Bug Reports

### Bug Report Template

```markdown
## Bug Description
Clear description of the bug

## Steps to Reproduce
1. Go to '...'
2. Click on '...'
3. See error

## Expected Behavior
What should happen

## Actual Behavior
What actually happens

## Environment
- Browser: Chrome 120
- OS: Windows 11
- PHP Version: 7.4

## Screenshots
If applicable
```

---

## 💡 Feature Requests

### Feature Request Template

```markdown
## Feature Description
Clear description of the feature

## Use Case
Why is this feature needed?

## Proposed Solution
How should it work?

## Alternatives Considered
Other approaches considered
```

---

## 🔒 Security

### Reporting Security Issues

**DO NOT** create public issues for security vulnerabilities.

Instead:
1. Email developer directly
2. Include detailed description
3. Include steps to reproduce
4. Wait for response before disclosing

---

## 📝 Code Review Checklist

### For Reviewers

- [ ] Code follows style guidelines
- [ ] Logic is clear and correct
- [ ] No security vulnerabilities
- [ ] Error handling is proper
- [ ] Documentation is updated
- [ ] Tests are included
- [ ] Commit messages are clear

---

## 🎯 Best Practices

### General
- Write self-documenting code
- Keep functions small and focused
- Use meaningful variable names
- Avoid magic numbers
- Handle errors gracefully

### PHP
- Always validate user input
- Use prepared statements (if using database)
- Sanitize output with `htmlspecialchars()`
- Use strict types
- Follow PSR-12 standard

### JavaScript
- Use `const` by default
- Avoid global variables
- Use async/await for promises
- Handle errors with try/catch
- Validate on client-side AND server-side

### Security
- Never trust user input
- Always validate server-side
- Use CSRF protection
- Implement rate limiting
- Keep dependencies updated

---

## 📞 Getting Help

### Resources
- **PLANNING.md** - Project architecture
- **TASK.md** - Current tasks and progress
- **docs/** - Detailed documentation
- **PHP Documentation** - https://www.php.net/
- **Brevo API Docs** - https://developers.brevo.com/

### Contact
- Developer: [Your Name]
- Email: [Your Email]

---

**Last Updated:** 2026-03-04  
**Version:** 1.0.0
