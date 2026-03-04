# Email Sequence Landing Page

A static landing page with PHP contact form that triggers an automated email sequence via Brevo API. DSGVO compliant and optimized for IONOS shared hosting.

---

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- IONOS shared hosting account (or similar)
- Brevo account (free tier)
- Domain with email address

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd email_sequence
   ```

2. **Configure Brevo API**
   ```bash
   cp public/api/config.example.php public/api/config.php
   ```
   Edit `public/api/config.php` and add your Brevo API credentials.

3. **Upload to IONOS**
   - Upload the `public/` folder contents to your web root via FTP
   - Ensure file permissions: 644 for files, 755 for directories
   - Verify PHP 7.4+ is enabled in IONOS control panel

4. **Test the form**
   - Visit your domain
   - Submit a test email
   - Check Brevo dashboard for new contact

---

## 📁 Project Structure

```
email_sequence/
├── .git/                       # Git repository
├── .gitignore                  # Git ignore file
├── README.md                   # This file
├── PLANNING.md                 # Project architecture & planning
├── TASK.md                     # Task tracking & milestones
├── CONTRIBUTING.md             # Development guidelines
│
├── public/                     # Web root (upload to IONOS)
│   ├── index.html             # Landing page
│   ├── impressum.html         # Legal imprint
│   ├── datenschutz.html       # Privacy policy
│   ├── success.html           # Success page
│   ├── error.html             # Error page
│   │
│   ├── css/
│   │   └── style.css          # Custom styles
│   │
│   ├── js/
│   │   └── form.js            # Form validation & AJAX
│   │
│   ├── api/
│   │   ├── submit.php         # Form handler
│   │   ├── brevo.php          # Brevo API helper
│   │   ├── config.php         # Configuration (not in git)
│   │   └── config.example.php # Config template
│   │
│   └── assets/
│       ├── images/            # Images
│       └── fonts/             # Fonts
│
├── tests/                      # Unit tests
│   └── test_form.php
│
└── docs/                       # Documentation
    ├── DEPLOYMENT.md          # IONOS deployment guide
    ├── BREVO_SETUP.md         # Brevo configuration
    ├── FLOWCHART.md           # Process flowchart
    └── BENUTZERHANDBUCH.md    # User manual (German)
```

---

## ⚙️ Configuration

### Brevo API Setup

1. **Create Brevo Account**
   - Sign up at [brevo.com](https://www.brevo.com/)
   - Verify your email address

2. **Generate API Key**
   - Go to Settings → SMTP & API → API Keys
   - Create new API key
   - Copy the key

3. **Create Contact List**
   - Go to Contacts → Lists
   - Create new list
   - Note the List ID

4. **Configure Email Templates**
   - Go to Campaigns → Templates
   - Create 3-5 email templates
   - Set up automation workflow

5. **Update config.php**
   ```php
   define('BREVO_API_KEY', 'your-api-key-here');
   define('BREVO_LIST_ID', 2); // Your list ID
   define('BREVO_SENDER_EMAIL', 'noreply@yourdomain.com');
   define('BREVO_SENDER_NAME', 'Your Company Name');
   ```

### IONOS Deployment

See detailed instructions in `docs/DEPLOYMENT.md`

---

## 🎨 Features

### Current Features
- ✅ Static landing page with contact form
- ✅ Client-side form validation (JavaScript)
- ✅ Server-side form validation (PHP)
- ✅ CSRF protection
- ✅ Rate limiting (3 submissions per IP per hour)
- ✅ Honeypot spam protection
- ✅ Brevo API integration
- ✅ Automated email sequence (3-5 emails)
- ✅ DSGVO compliant (Impressum, Datenschutz)
- ✅ Mobile responsive design
- ✅ HTTPS/SSL support

### Optional Features
- ⚠️ Double opt-in email verification (can be enabled)
- 📊 Analytics tracking (can be added)

---

## 🔒 Security

### Implemented Security Measures
- **CSRF Protection**: Token-based validation
- **Input Validation**: Server-side + client-side
- **Rate Limiting**: Max 3 submissions per IP per hour
- **Honeypot Field**: Bot detection
- **Input Sanitization**: htmlspecialchars() for all inputs
- **API Key Security**: Stored in config.php (not in git)
- **HTTPS Only**: Force SSL on IONOS
- **.htaccess Protection**: Deny access to sensitive files

---

## 📧 Email Sequence

### Default Sequence (Brevo Automation)
1. **Email 1**: Welcome + Introduction (Day 0)
2. **Email 2**: Value/Benefit #1 (Day 2-3)
3. **Email 3**: Value/Benefit #2 (Day 4-5)
4. **Email 4**: Call to Action (Day 7)
5. **Email 5**: Follow-up (Day 14) - Optional

### Customizing Email Templates
See `docs/BREVO_SETUP.md` for detailed instructions on how to edit email templates in Brevo.

---

## 🧪 Testing

### Local Testing
```bash
# Start PHP development server
cd public
php -S localhost:8000
```

Open browser: `http://localhost:8000`

### Test Checklist
- [ ] Form validation works (client-side)
- [ ] Form submission works (server-side)
- [ ] Brevo contact added successfully
- [ ] Email sequence triggered
- [ ] DSGVO pages accessible
- [ ] Mobile responsive
- [ ] HTTPS enabled (on IONOS)
- [ ] Error handling works

---

## 🚀 Deployment

### Quick Deployment to IONOS

1. **Connect via FTP**
   - Host: `ftp.yourdomain.com`
   - Username: Your IONOS FTP username
   - Password: Your IONOS FTP password

2. **Upload Files**
   - Upload contents of `public/` folder to web root
   - Ensure `config.php` is uploaded with correct credentials

3. **Set Permissions**
   ```
   Files: 644
   Directories: 755
   ```

4. **Enable HTTPS**
   - Go to IONOS control panel
   - Enable SSL/HTTPS for your domain

5. **Test**
   - Visit your domain
   - Submit test form
   - Verify in Brevo dashboard

See `docs/DEPLOYMENT.md` for detailed deployment instructions.

---

## 📚 Documentation

### For Developers
- **PLANNING.md** - Complete project architecture and technical specifications
- **TASK.md** - Detailed task breakdown and milestones
- **CONTRIBUTING.md** - Development guidelines and code style
- **docs/DEPLOYMENT.md** - IONOS deployment guide
- **docs/BREVO_SETUP.md** - Brevo API configuration
- **docs/FLOWCHART.md** - Process flow diagrams

### For Clients (German)
- **docs/BENUTZERHANDBUCH.md** - User manual in German
- How to update email templates in Brevo
- How to view analytics in Brevo
- How to export contacts from Brevo
- Troubleshooting guide

---

## 🛠️ Development

### Git Workflow
```bash
# Create feature branch
git checkout -b feature/form-validation

# Make changes and commit
git add .
git commit -m "feat: add email validation to contact form"

# Push to repository
git push origin feature/form-validation
```

### Commit Message Format
```
feat: add new feature
fix: resolve bug
docs: update documentation
style: improve styling
test: add unit tests
```

---

## 🆘 Troubleshooting

### Form Not Submitting
- Check PHP error logs on IONOS
- Verify BREVO_API_KEY is correct in config.php
- Check browser console for JavaScript errors
- Verify AJAX endpoint URL is correct

### Emails Not Sending
- Check Brevo API key is valid
- Verify contact was added to Brevo list
- Check automation workflow is active in Brevo
- Verify sender email is verified in Brevo

### IONOS Deployment Issues
- Check file permissions (644 for files, 755 for directories)
- Verify PHP version is 7.4+ in IONOS control panel
- Check .htaccess syntax
- Verify config.php exists and is readable

See `docs/TROUBLESHOOTING.md` for more solutions.

---

## 📊 Tech Stack

| Component | Technology | Version |
|-----------|-----------|---------|
| Frontend | HTML5 + CSS3 + JavaScript | - |
| Styling | TailwindCSS (CDN) | 3.x |
| Backend | PHP | 7.4+ |
| Email Service | Brevo API | v3 |
| Hosting | IONOS Shared Hosting | - |
| Version Control | Git | - |

---

## 📝 License

This project is proprietary and confidential.

---

## 👥 Support

### For Technical Issues
- Developer: [Your Name]
- Email: [Your Email]

### For Brevo Support
- Brevo Help Center: https://help.brevo.com/
- Brevo API Docs: https://developers.brevo.com/

### For IONOS Support
- IONOS Help Center: https://www.ionos.de/hilfe/

---

## 🔄 Changelog

### Version 1.0.0 (2026-03-04)
- Initial project setup
- Created PLANNING.md and TASK.md
- Initialized git repository
- Created project folder structure

---

**Last Updated:** 2026-03-04  
**Version:** 1.0.0  
**Status:** Planning Phase
