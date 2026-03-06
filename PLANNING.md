# PLANNING.md - Email Sequence Landing Page

**Project Name:** Email Sequence Landing Page  
**Created:** 2026-03-04  
**Last Updated:** 2026-03-04  
**Status:** Planning Phase  
**Hosting:** IONOS  
**Primary Language:** German (UX), English (Code/Comments)

---

## 📋 Project Overview

### Purpose
A static landing page with PHP contact form that collects user information and triggers an automated email sequence (3-5 emails) via Brevo API integration. Users receive a unique link to access the page.

### Client Information
- **Domain**: teammehrwert.info (IONOS)
- **Email**: Office@teammehrwert.info
- **Access**: Link shared privately within team (not publicly posted)
- **Design**: Clean, minimalist design
- **Font**: The Seasons (serif typeface)

### Customer Requirements
> "Die Landingpage mit dem Formular zum Eintragen soll möglichst clean gehalten werden. Website wird nur per Link in unser Team weitergeleitet. Da brauchen wir glaube nicht mehr. Der Link wird nicht öffentlich gepostet."

### Key Features
1. **Static Landing Page** - Simple, clean design
2. **PHP Contact Form** - Email collection with validation
3. **DSGVO Compliance** - Impressum, Datenschutz pages
4. **Email Verification** - Optional double opt-in (can be skipped if legally not required since only users with link access the page)
5. **Brevo Integration** - Automated email sequence (3-5 emails)
6. **IONOS Hosting** - Must be compatible with IONOS shared hosting

---

## 🎯 Project Goals

### Primary Goals
- ✅ Collect email addresses via simple form
- ✅ Trigger automated email sequence via Brevo
- ✅ DSGVO compliant (Impressum, Datenschutz)
- ✅ Works on IONOS shared hosting
- ✅ Mobile responsive design

### Optional Goals
- ⚠️ Double opt-in email verification (only if legally required)
- 📊 Simple analytics (optional)

---

## 🏗️ Technical Architecture

### Tech Stack

| Component | Technology | Reason |
|-----------|-----------|--------|
| **Frontend** | HTML5 + CSS3 + Vanilla JS | Static, no framework needed |
| **Styling** | TailwindCSS (via CDN) | Modern, responsive, no build step |
| **Backend** | PHP 7.4+ | IONOS standard, no Node.js needed |
| **Email Service** | Brevo API | Free tier: 300 emails/day |
| **Hosting** | IONOS Shared Hosting | Customer requirement |
| **Database** | None (optional: SQLite for logs) | Keep it simple |
| **Version Control** | Git | Standard practice |

### Why This Stack?
- **No Build Process**: Static HTML/CSS/JS works directly on IONOS
- **PHP Native**: IONOS supports PHP out of the box
- **No Database Required**: Brevo stores contacts
- **Easy Deployment**: Just FTP upload
- **Low Maintenance**: Minimal dependencies

---

## 📁 Project Structure

```
email_sequence/
├── .git/                       # Git repository
├── .gitignore                  # Git ignore file
├── README.md                   # Setup instructions
├── PLANNING.md                 # This file
├── TASK.md                     # Task tracking
├── CONTRIBUTING.md             # Development guidelines
│
├── public/                     # Web root (upload to IONOS)
│   ├── index.html             # Landing page
│   ├── impressum.html         # Legal imprint
│   ├── datenschutz.html       # Privacy policy
│   ├── success.html           # Success page after form submit
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
│   │   ├── config.php         # Configuration (not in git)
│   │   └── config.example.php # Config template
│   │
│   └── assets/
│       ├── images/            # Logo files
│       │   ├── logo_alpha.svg # Logo without background
│       │   └── logo_white_bg.png # Logo with white background
│       └── fonts/             # The Seasons font family (6 OTF files)
│           ├── fonnts.com-theseasons-reg.otf
│           ├── fonnts.com-theseasons-lt.otf
│           ├── fonnts.com-theseasons-bd.otf
│           ├── fonnts.com-theseasons-it.otf
│           ├── fonnts.com-theseasons-ltit.otf
│           └── fonnts.com-theseasons-bdit.otf
│
├── tests/                      # Unit tests (optional)
│   └── test_form.php
│
└── docs/                       # Documentation
    ├── DEPLOYMENT.md          # IONOS deployment guide
    ├── BREVO_SETUP.md         # Brevo configuration
    └── FLOWCHART.md           # Process flowchart
```

---

## 🔄 User Flow

### Standard Flow (Without Double Opt-In)
```
1. User receives unique link → Opens landing page
2. User fills form (Name + Email + DSGVO checkboxes)
3. JavaScript validates input
4. AJAX POST to submit.php
5. PHP validates data
6. PHP calls Brevo API → Add contact to list
7. Brevo triggers email sequence (3-5 emails)
8. User sees success message
```

### Optional Flow (With Double Opt-In)
```
1. User receives unique link → Opens landing page
2. User fills form (Name + Email + DSGVO checkboxes)
3. JavaScript validates input
4. AJAX POST to submit.php
5. PHP validates data
6. PHP calls Brevo API → Add contact with DOI_PENDING=true
7. PHP sends confirmation email with verification link
8. User clicks verification link → verify.php
9. PHP updates Brevo contact → DOI_CONFIRMED=true
10. Brevo triggers email sequence (3-5 emails)
11. User sees success message
```

---

## 🎨 Design Guidelines

### Design Inspiration
Reference project: `/home/nop/CascadeProjects/CRM-Funnel-Prototype-main`

### Style Principles
- **Minimalist**: Clean, simple, no clutter
- **Neutral Colors**: Gray, white, subtle accents
- **Mobile-First**: Responsive design
- **Accessibility**: WCAG 2.1 AA compliant
- **Fast Loading**: Minimal assets, CDN for libraries

### Color Palette
```css
--color-primary: #1f2937;      /* Gray 800 */
--color-secondary: #6b7280;    /* Gray 500 */
--color-accent: #3b82f6;       /* Blue 500 */
--color-background: #f9fafb;   /* Gray 50 */
--color-white: #ffffff;
--color-error: #ef4444;        /* Red 500 */
--color-success: #10b981;      /* Green 500 */
```

### Typography
- **Primary Font**: The Seasons (serif typeface)
  - Available in 6 styles: Regular, Light, Bold, Italic, Light Italic, Bold Italic
  - Self-hosted OTF files in `public/assets/fonts/`
- **Headings**: The Seasons Regular/Bold
- **Body**: The Seasons Light/Regular
- **Font Sizes**: Responsive (clamp() for fluid typography)

---

## 🔒 DSGVO Compliance

### Required Elements
1. ✅ **Impressum** (Legal Imprint)
   - Company/Person name
   - Address
   - Contact details
   - Responsible person

2. ✅ **Datenschutzerklärung** (Privacy Policy)
   - Data collection explanation
   - Brevo mentioned
   - IONOS hosting mentioned
   - User rights (access, deletion, portability)
   - Double opt-in process (if used)

3. ✅ **Consent Checkboxes**
   - Privacy policy acceptance (required)
   - Email marketing consent (required)
   - Separate checkboxes (not pre-checked)

4. ✅ **Unsubscribe Link**
   - In every Brevo email (automatic)

5. ⚠️ **Double Opt-In** (Optional)
   - Only if legally required
   - Can be skipped if users only access via unique link

### Data Processing
- **Collected Data**: Name, Email, Timestamp, IP (optional)
- **Storage**: Brevo (EU servers)
- **Purpose**: Email sequence delivery
- **Retention**: Until user unsubscribes
- **Third Parties**: Brevo, IONOS

---

## 📧 Brevo Integration

### API Setup
1. Create Brevo account (free tier)
2. Generate API key
3. Create contact list
4. Configure email templates (3-5)
5. Set up automation workflow

### Email Sequence Structure
```
Email 1: Welcome + Introduction (Day 0)
Email 2: Value/Benefit #1 (Day 2-3)
Email 3: Value/Benefit #2 (Day 4-5)
Email 4: Call to Action (Day 7)
Email 5: Follow-up (Day 14) - Optional
```

### API Endpoints Used
- `POST /v3/contacts` - Add contact to list
- `PUT /v3/contacts/{email}` - Update contact attributes
- `POST /v3/smtp/email` - Send transactional email (for DOI)

### Brevo Configuration
```php
// config.php
define('BREVO_API_KEY', 'your-api-key-here');
define('BREVO_LIST_ID', 2); // Your list ID
define('BREVO_SENDER_EMAIL', 'Office@teammehrwert.info');
define('BREVO_SENDER_NAME', 'Team Mehrwert');
```

---

## 🔐 Security Considerations

### Form Security
- ✅ **CSRF Protection**: Token-based
- ✅ **Input Validation**: Server-side + client-side
- ✅ **Email Validation**: RFC 5322 compliant
- ✅ **Rate Limiting**: Max 3 submissions per IP per hour
- ✅ **Honeypot Field**: Bot detection
- ✅ **Sanitization**: htmlspecialchars() for all inputs

### API Security
- ✅ **API Key**: Stored in config.php (not in git)
- ✅ **HTTPS Only**: Force SSL on IONOS
- ✅ **Error Handling**: No sensitive data in error messages

### File Security
- ✅ **config.php**: Outside web root or .htaccess protected
- ✅ **.htaccess**: Deny access to sensitive files
- ✅ **File Permissions**: 644 for files, 755 for directories

---

## 🚀 Deployment Strategy

### IONOS Deployment
1. **FTP Upload**: Upload `public/` folder to web root
2. **Configure PHP**: Ensure PHP 7.4+ is enabled
3. **Set Permissions**: 644 for files, 755 for dirs
4. **Create config.php**: Copy from config.example.php
5. **Test Form**: Submit test email
6. **Verify Brevo**: Check contact added to list

### Environment Variables
```php
// config.php (not in git)
define('BREVO_API_KEY', 'xkeysib-...');
define('BREVO_LIST_ID', 2);
define('BREVO_SENDER_EMAIL', 'Office@teammehrwert.info');
define('BREVO_SENDER_NAME', 'Team Mehrwert');
define('SITE_URL', 'https://teammehrwert.info');
define('ENABLE_DOUBLE_OPT_IN', false); // Not required - private link access only
```

### Testing Checklist
- [ ] Form validation works (client-side)
- [ ] Form submission works (server-side)
- [ ] Brevo contact added successfully
- [ ] Email sequence triggered
- [ ] DSGVO pages accessible
- [ ] Mobile responsive
- [ ] HTTPS enabled
- [ ] Error handling works

---

## 📊 Success Metrics

### Technical Metrics
- ✅ Page load time < 2 seconds
- ✅ Mobile responsive (all devices)
- ✅ Form submission success rate > 95%
- ✅ Brevo API success rate > 99%
- ✅ Zero security vulnerabilities

### Business Metrics
- 📈 Email collection rate
- 📈 Email open rate (Brevo analytics)
- 📈 Email click rate (Brevo analytics)
- 📈 Unsubscribe rate < 5%

---

## 🛠️ Development Workflow

### Git Workflow
1. **main** branch: Production-ready code
2. **develop** branch: Development work
3. Feature branches: `feature/form-validation`
4. Commit messages: Conventional commits format

### Commit Message Format
```
feat: add email validation to contact form
fix: resolve CSRF token validation issue
docs: update BREVO_SETUP.md with API instructions
style: improve mobile responsiveness
test: add unit tests for form validation
```

### Code Style
- **PHP**: PSR-12 coding standard
- **JavaScript**: ES6+, semicolons, 2-space indent
- **HTML**: Semantic HTML5, 2-space indent
- **CSS**: BEM naming convention (optional)

---

## 📝 Documentation Requirements

### For Developers
- ✅ README.md - Quick start guide
- ✅ PLANNING.md - This file
- ✅ TASK.md - Task tracking
- ✅ CONTRIBUTING.md - Development guidelines
- ✅ docs/DEPLOYMENT.md - IONOS deployment
- ✅ docs/BREVO_SETUP.md - Brevo configuration
- ✅ docs/FLOWCHART.md - Process flowchart

### For Client
- ✅ User manual (German)
- ✅ How to update email templates in Brevo
- ✅ How to view analytics in Brevo
- ✅ How to export contacts from Brevo
- ✅ Troubleshooting guide

---

## 🔄 Future Enhancements (Optional)

### Phase 2 (If Requested)
- 📊 Analytics dashboard (simple PHP page)
- 📧 Monthly newsletter automation
- 🎨 A/B testing for email templates
- 📱 SMS notifications (Brevo supports SMS)
- 🔗 UTM tracking for email links
- 📈 Conversion tracking

### Phase 3 (If Requested)
- 🗄️ SQLite database for local logging
- 📊 Admin panel for viewing submissions
- 🔒 Advanced spam protection (reCAPTCHA)
- 🌍 Multi-language support
- 📧 Custom email templates

---

## ⚠️ Known Limitations

### IONOS Shared Hosting
- ❌ No Node.js (use PHP only)
- ❌ Limited cron jobs (use Brevo automation instead)
- ❌ No SSH access (FTP only)
- ✅ PHP 7.4+ supported
- ✅ HTTPS/SSL available
- ✅ .htaccess supported

### Brevo Free Tier
- ✅ 300 emails/day (sufficient for this use case)
- ✅ Unlimited contacts
- ✅ Email automation included
- ❌ Brevo branding in emails (can be removed with paid plan)

---

## 🆘 Troubleshooting

### Common Issues

#### Form Not Submitting
- Check PHP error logs
- Verify BREVO_API_KEY is correct
- Check CORS settings
- Verify AJAX endpoint URL

#### Emails Not Sending
- Check Brevo API key
- Verify contact added to list
- Check automation workflow is active
- Verify sender email is verified in Brevo

#### IONOS Deployment Issues
- Check file permissions (644/755)
- Verify PHP version (7.4+)
- Check .htaccess syntax
- Verify config.php exists and is readable

---

## 📞 Support & Maintenance

### Developer Handoff
- All code documented with inline comments
- README.md with setup instructions
- DEPLOYMENT.md with IONOS guide
- config.example.php with all settings explained

### Client Handoff
- User manual in German
- Brevo dashboard access
- FTP credentials for IONOS
- Emergency contact (developer)

---

## ✅ Project Milestones

### Milestone 1: Planning & Setup (Day 1)
- [x] Create PLANNING.md
- [ ] Create TASK.md
- [ ] Initialize git repository
- [ ] Create folder structure
- [ ] Create README.md

### Milestone 2: Frontend Development (Day 2-3)
- [ ] Create landing page HTML
- [ ] Add TailwindCSS styling
- [ ] Create Impressum page
- [ ] Create Datenschutz page
- [ ] Add form validation (JavaScript)
- [ ] Mobile responsive testing

### Milestone 3: Backend Development (Day 4-5)
- [ ] Create submit.php handler
- [ ] Implement Brevo API integration
- [ ] Add CSRF protection
- [ ] Add rate limiting
- [ ] Error handling
- [ ] Optional: Double opt-in flow

### Milestone 4: Testing & Deployment (Day 6)
- [ ] Local testing
- [ ] Brevo integration testing
- [ ] IONOS deployment
- [ ] Production testing
- [ ] Client review

### Milestone 5: Documentation & Handoff (Day 7)
- [ ] Complete all documentation
- [ ] Create user manual (German)
- [ ] Client training
- [ ] Final acceptance

---

## 📅 Timeline Estimate

| Phase | Duration | Status |
|-------|----------|--------|
| Planning & Setup | 1 day | In Progress |
| Frontend Development | 2 days | Pending |
| Backend Development | 2 days | Pending |
| Testing & Deployment | 1 day | Pending |
| Documentation & Handoff | 1 day | Pending |
| **Total** | **7 days** | **Planning** |

---

## 🎓 Learning Resources

### For Developers
- [Brevo API Documentation](https://developers.brevo.com/)
- [PHP Best Practices](https://phptherightway.com/)
- [DSGVO Compliance Guide](https://gdpr.eu/)
- [IONOS PHP Hosting Docs](https://www.ionos.de/hilfe/)

### For Client
- [Brevo User Guide](https://help.brevo.com/)
- [Email Marketing Best Practices](https://www.brevo.com/blog/)

---

**Last Updated:** 2026-03-04  
**Next Review:** After Milestone 1 completion
