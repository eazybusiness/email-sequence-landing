# IONOS Deployment Guide

Complete guide for deploying the Email Sequence Landing Page to IONOS shared hosting.

---

## 📋 Prerequisites

Before deployment, ensure you have:
- ✅ IONOS shared hosting account
- ✅ Domain configured in IONOS
- ✅ FTP credentials from IONOS
- ✅ Brevo account with API key
- ✅ All files tested locally

---

## 🚀 Deployment Steps

### Step 1: Prepare Configuration

1. **Create config.php**
   ```bash
   cd public/api
   cp config.example.php config.php
   ```

2. **Edit config.php**
   ```php
   <?php
   declare(strict_types=1);
   
   // Brevo API Configuration
   define('BREVO_API_KEY', 'xkeysib-your-actual-api-key-here');
   define('BREVO_LIST_ID', 2); // Your actual list ID
   define('BREVO_SENDER_EMAIL', 'noreply@yourdomain.com');
   define('BREVO_SENDER_NAME', 'Your Company Name');
   
   // Site Configuration
   define('SITE_URL', 'https://yourdomain.com');
   define('ENABLE_DOUBLE_OPT_IN', false);
   
   // Security Configuration
   define('RATE_LIMIT_MAX', 3); // Max submissions per IP per hour
   define('CSRF_TOKEN_EXPIRY', 3600); // 1 hour
   ```

3. **Verify .gitignore**
   Ensure `config.php` is in `.gitignore` to prevent committing sensitive data.

---

### Step 2: Connect to IONOS via FTP

#### Option A: FileZilla (Recommended)

1. **Download FileZilla**
   - Download from: https://filezilla-project.org/

2. **Configure Connection**
   - Host: `ftp.yourdomain.com` or IONOS FTP server
   - Username: Your IONOS FTP username
   - Password: Your IONOS FTP password
   - Port: 21 (FTP) or 22 (SFTP if available)

3. **Connect**
   - Click "Quickconnect"
   - Accept certificate if prompted

#### Option B: Command Line FTP

```bash
ftp ftp.yourdomain.com
# Enter username and password when prompted
```

---

### Step 3: Upload Files

1. **Navigate to Web Root**
   - Usually: `/` or `/html` or `/public_html`
   - Check IONOS documentation for your specific setup

2. **Upload Public Folder Contents**
   Upload the entire contents of the `public/` folder:
   ```
   public/
   ├── index.html
   ├── impressum.html
   ├── datenschutz.html
   ├── success.html
   ├── error.html
   ├── css/
   ├── js/
   ├── api/
   └── assets/
   ```

3. **Verify Upload**
   - Check all files uploaded successfully
   - Verify folder structure is correct

---

### Step 4: Set File Permissions

Set correct permissions for security:

| File/Folder | Permission | Reason |
|-------------|------------|--------|
| Files (*.html, *.css, *.js) | 644 | Read/write for owner, read for others |
| Directories | 755 | Execute permission for directories |
| api/config.php | 600 | Only owner can read/write |
| api/*.php | 644 | Standard PHP file permissions |

**In FileZilla:**
- Right-click file/folder → File permissions
- Enter numeric value (e.g., 644)

**Via FTP command line:**
```bash
chmod 644 index.html
chmod 755 css/
chmod 600 api/config.php
```

---

### Step 5: Configure PHP in IONOS

1. **Access IONOS Control Panel**
   - Login to https://www.ionos.de/
   - Go to "Hosting" section

2. **Check PHP Version**
   - Ensure PHP 7.4 or higher is enabled
   - If not, enable it in control panel

3. **PHP Settings (Optional)**
   - `upload_max_filesize`: 10M (default is fine)
   - `post_max_size`: 10M (default is fine)
   - `max_execution_time`: 30 (default is fine)

---

### Step 6: Enable HTTPS/SSL

1. **Access SSL Settings**
   - Go to IONOS Control Panel → SSL

2. **Enable SSL Certificate**
   - IONOS provides free SSL certificates
   - Enable "Force HTTPS" option

3. **Verify HTTPS**
   - Visit: `https://yourdomain.com`
   - Check for padlock icon in browser

4. **Update config.php**
   ```php
   define('SITE_URL', 'https://yourdomain.com'); // Use https://
   ```

---

### Step 7: Configure .htaccess

Create `.htaccess` in web root:

```apache
# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Protect config.php
<Files "config.php">
    Order allow,deny
    Deny from all
</Files>

# Protect .git directory
<DirectoryMatch "\.git">
    Order allow,deny
    Deny from all
</DirectoryMatch>

# Security Headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Disable directory listing
Options -Indexes

# Custom error pages
ErrorDocument 404 /error.html
ErrorDocument 500 /error.html
```

Upload this file to web root with permission 644.

---

### Step 8: Test Deployment

#### 8.1 Test Page Load
- Visit: `https://yourdomain.com`
- Verify page loads correctly
- Check mobile responsive

#### 8.2 Test Form Submission
1. Fill out form with test data
2. Submit form
3. Check for success message
4. Verify in Brevo dashboard that contact was added

#### 8.3 Test Legal Pages
- Visit: `https://yourdomain.com/impressum.html`
- Visit: `https://yourdomain.com/datenschutz.html`
- Verify content displays correctly

#### 8.4 Test Error Handling
- Submit form with invalid email
- Verify error message displays
- Submit form multiple times (test rate limiting)

---

### Step 9: Verify Brevo Integration

1. **Check Brevo Dashboard**
   - Login to Brevo
   - Go to Contacts → Lists
   - Verify test contact appears

2. **Check Email Sequence**
   - Verify automation workflow is active
   - Check that Email 1 was sent
   - Wait for subsequent emails

3. **Test Unsubscribe**
   - Click unsubscribe link in email
   - Verify contact is unsubscribed in Brevo

---

## 🔍 Troubleshooting

### Issue: Page Shows 500 Error

**Possible Causes:**
- PHP syntax error
- Incorrect file permissions
- Missing config.php

**Solutions:**
1. Check IONOS error logs
2. Verify PHP version is 7.4+
3. Check file permissions (644 for files, 755 for dirs)
4. Verify config.php exists and is readable

---

### Issue: Form Not Submitting

**Possible Causes:**
- JavaScript error
- AJAX endpoint incorrect
- CORS issue
- PHP error

**Solutions:**
1. Check browser console for errors
2. Verify AJAX URL is correct
3. Check PHP error logs
4. Test with browser network tab

---

### Issue: Brevo API Error

**Possible Causes:**
- Invalid API key
- API rate limit exceeded
- Invalid list ID
- Sender email not verified

**Solutions:**
1. Verify API key in config.php
2. Check Brevo account status
3. Verify list ID is correct
4. Verify sender email is verified in Brevo

---

### Issue: HTTPS Not Working

**Possible Causes:**
- SSL not enabled in IONOS
- .htaccess redirect not working
- Mixed content (http/https)

**Solutions:**
1. Enable SSL in IONOS control panel
2. Verify .htaccess uploaded correctly
3. Check all resources use https://

---

### Issue: Emails Not Sending

**Possible Causes:**
- Automation workflow not active
- Contact not added to list
- Email templates not configured
- Sender email not verified

**Solutions:**
1. Check automation workflow in Brevo
2. Verify contact in Brevo dashboard
3. Check email templates exist
4. Verify sender email in Brevo settings

---

## 📊 Post-Deployment Checklist

- [ ] Page loads at https://yourdomain.com
- [ ] Form validation works (client-side)
- [ ] Form submission works (server-side)
- [ ] Contact added to Brevo successfully
- [ ] Email sequence triggered
- [ ] Impressum page accessible
- [ ] Datenschutz page accessible
- [ ] Mobile responsive on all devices
- [ ] HTTPS enabled and working
- [ ] Error handling works
- [ ] Rate limiting works
- [ ] CSRF protection works
- [ ] Honeypot spam protection works

---

## 🔄 Updating the Site

### To Update Content

1. **Edit files locally**
2. **Test changes locally**
3. **Upload changed files via FTP**
4. **Clear browser cache and test**

### To Update Email Templates

1. **Login to Brevo**
2. **Go to Campaigns → Templates**
3. **Edit template**
4. **Save changes**
5. **Test by submitting form**

---

## 🔒 Security Best Practices

### Regular Maintenance

- [ ] Update PHP version when available
- [ ] Monitor Brevo API usage
- [ ] Check error logs weekly
- [ ] Review form submissions for spam
- [ ] Update .htaccess security headers

### Backup Strategy

1. **Weekly Backups**
   - Download all files via FTP
   - Export Brevo contacts
   - Store securely

2. **Before Major Changes**
   - Backup current version
   - Test changes locally first
   - Deploy during low-traffic hours

---

## 📞 Support Resources

### IONOS Support
- Help Center: https://www.ionos.de/hilfe/
- Phone: Check IONOS website for current number
- Email: Available in control panel

### Brevo Support
- Help Center: https://help.brevo.com/
- API Docs: https://developers.brevo.com/
- Email: support@brevo.com

---

## 📝 Deployment Log Template

Keep a log of deployments:

```
Date: 2026-03-XX
Version: 1.0.0
Changes:
- Initial deployment
- Configured Brevo API
- Enabled HTTPS

Issues Encountered:
- None

Tested By: [Name]
Approved By: [Name]
```

---

**Last Updated:** 2026-03-04  
**Version:** 1.0.0
