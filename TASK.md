# TASK.md - Email Sequence Landing Page

**Project:** Email Sequence Landing Page  
**Created:** 2026-03-04  
**Last Updated:** 2026-03-04  
**Status:** Planning Phase

---

## 📋 Current Sprint: Planning & Setup

### Active Tasks
- [x] Create PLANNING.md with complete architecture
- [ ] Create TASK.md (this file)
- [ ] Initialize git repository
- [ ] Create .gitignore file
- [ ] Create README.md
- [ ] Create project folder structure
- [ ] Create CONTRIBUTING.md

---

## 🎯 Milestone 1: Planning & Setup (Day 1)

**Goal:** Complete project planning and initialize repository  
**Status:** 🔄 In Progress  
**Due:** 2026-03-04

### Tasks

#### Documentation
- [x] Create PLANNING.md
  - [x] Define project overview
  - [x] Define technical architecture
  - [x] Define folder structure
  - [x] Define user flows
  - [x] Define DSGVO requirements
  - [x] Define Brevo integration
  - [x] Define security measures
  - [x] Define deployment strategy

- [ ] Create TASK.md
  - [ ] Define all milestones
  - [ ] Break down tasks by milestone
  - [ ] Add acceptance criteria
  - [ ] Add time estimates

- [ ] Create README.md
  - [ ] Project description
  - [ ] Quick start guide
  - [ ] Installation instructions
  - [ ] Configuration guide
  - [ ] Deployment instructions

- [ ] Create CONTRIBUTING.md
  - [ ] Code style guidelines
  - [ ] Git workflow
  - [ ] Commit message format
  - [ ] Testing requirements

#### Repository Setup
- [ ] Initialize git repository
  - [ ] Run `git init`
  - [ ] Create initial commit

- [ ] Create .gitignore
  - [ ] Ignore config.php
  - [ ] Ignore IDE files
  - [ ] Ignore OS files
  - [ ] Ignore logs

- [ ] Create folder structure
  - [ ] Create public/ directory
  - [ ] Create public/css/ directory
  - [ ] Create public/js/ directory
  - [ ] Create public/api/ directory
  - [ ] Create public/assets/ directory
  - [ ] Create tests/ directory
  - [ ] Create docs/ directory

#### Additional Documentation
- [ ] Create docs/DEPLOYMENT.md
  - [ ] IONOS FTP setup
  - [ ] PHP configuration
  - [ ] SSL/HTTPS setup
  - [ ] Testing checklist

- [ ] Create docs/BREVO_SETUP.md
  - [ ] Account creation
  - [ ] API key generation
  - [ ] Contact list setup
  - [ ] Email template creation
  - [ ] Automation workflow setup

- [ ] Create docs/FLOWCHART.md
  - [ ] User flow diagram
  - [ ] Data flow diagram
  - [ ] Email sequence flow

### Acceptance Criteria
- ✅ All documentation files created
- ✅ Git repository initialized
- ✅ Folder structure complete
- ✅ README.md has clear setup instructions
- ✅ PLANNING.md reviewed and approved

---

## 🎯 Milestone 2: Frontend Development (Day 2-3)

**Goal:** Complete all HTML pages and styling  
**Status:** ⏳ Pending  
**Due:** 2026-03-06

### Tasks

#### Landing Page (index.html)
- [ ] Create HTML structure
  - [ ] Header with logo/title
  - [ ] Hero section with headline
  - [ ] Contact form section
  - [ ] Footer with legal links
  - [ ] Success/error message containers

- [ ] Create contact form
  - [ ] Vorname (First name) input field (required)
  - [ ] Name (Last name) input field (required)
  - [ ] Email input field (required)
  - [ ] Mobilfunknummer (Mobile number) input field (required)
  - [ ] Mentor input field (required)
  - [ ] DSGVO checkbox 1: Privacy policy (required)
  - [ ] DSGVO checkbox 2: Email marketing consent (required)
  - [ ] Honeypot field (hidden, for bot detection)
  - [ ] Submit button
  - [ ] Loading state indicator

- [ ] Add TailwindCSS styling
  - [ ] Include TailwindCSS via CDN
  - [ ] Apply minimalist design
  - [ ] Use neutral color palette
  - [ ] Add hover/focus states
  - [ ] Add animations (subtle)

- [ ] Create custom CSS (css/style.css)
  - [ ] Custom component styles
  - [ ] Form validation states
  - [ ] Loading animations
  - [ ] Error/success messages

#### Legal Pages
- [ ] Create impressum.html
  - [ ] Copy structure from reference project
  - [ ] Add placeholder content
  - [ ] Match landing page design
  - [ ] Add back navigation

- [ ] Create datenschutz.html
  - [ ] Copy structure from reference project
  - [ ] Customize for this project (Brevo, IONOS)
  - [ ] Explain data collection
  - [ ] Explain email sequence
  - [ ] Add user rights section
  - [ ] Match landing page design

#### Additional Pages
- [ ] Create success.html
  - [ ] Success message
  - [ ] Next steps information
  - [ ] Link back to homepage

- [ ] Create error.html
  - [ ] Error message
  - [ ] Troubleshooting tips
  - [ ] Contact information
  - [ ] Link back to homepage

#### JavaScript (js/form.js)
- [ ] Form validation (client-side)
  - [ ] Validate Vorname (min 2 chars)
  - [ ] Validate Name (min 2 chars)
  - [ ] Validate email (RFC 5322)
  - [ ] Validate Mobilfunknummer (German mobile format)
  - [ ] Validate Mentor (min 2 chars)
  - [ ] Validate checkboxes (both required)
  - [ ] Show inline error messages
  - [ ] Prevent submission if invalid

- [ ] AJAX form submission
  - [ ] Prevent default form submit
  - [ ] Show loading state
  - [ ] POST to api/submit.php
  - [ ] Handle success response
  - [ ] Handle error response
  - [ ] Show success/error message

- [ ] Honeypot validation
  - [ ] Check honeypot field is empty
  - [ ] Block submission if filled

#### Responsive Design
- [ ] Mobile optimization (< 640px)
  - [ ] Stack form fields vertically
  - [ ] Adjust font sizes
  - [ ] Touch-friendly buttons
  - [ ] Test on iOS Safari
  - [ ] Test on Android Chrome

- [ ] Tablet optimization (640px - 1024px)
  - [ ] Adjust layout
  - [ ] Test on iPad
  - [ ] Test on Android tablet

- [ ] Desktop optimization (> 1024px)
  - [ ] Center content (max-width)
  - [ ] Larger form fields
  - [ ] Better spacing

### Acceptance Criteria
- ✅ All HTML pages created and styled
- ✅ Form validation works (client-side)
- ✅ AJAX submission implemented
- ✅ Mobile responsive on all devices
- ✅ Legal pages complete with placeholder content
- ✅ Design matches reference project style
- ✅ Accessibility: WCAG 2.1 AA compliant

---

## 🎯 Milestone 3: Backend Development (Day 4-5)

**Goal:** Complete PHP backend and Brevo integration  
**Status:** ⏳ Pending  
**Due:** 2026-03-08

### Tasks

#### Configuration
- [ ] Create api/config.example.php
  - [ ] BREVO_API_KEY constant
  - [ ] BREVO_LIST_ID constant
  - [ ] BREVO_SENDER_EMAIL constant
  - [ ] BREVO_SENDER_NAME constant
  - [ ] SITE_URL constant
  - [ ] ENABLE_DOUBLE_OPT_IN constant
  - [ ] RATE_LIMIT_MAX constant
  - [ ] Add detailed comments

- [ ] Create api/config.php (not in git)
  - [ ] Copy from config.example.php
  - [ ] Add real Brevo API key (later)
  - [ ] Add real configuration values

#### Form Handler (api/submit.php)
- [ ] Input validation (server-side)
  - [ ] Validate Vorname (trim, min 2 chars, max 100 chars)
  - [ ] Validate Name (trim, min 2 chars, max 100 chars)
  - [ ] Validate email (filter_var, RFC 5322)
  - [ ] Validate Mobilfunknummer (German mobile format)
  - [ ] Validate Mentor (trim, min 2 chars, max 100 chars)
  - [ ] Validate checkboxes (both must be true)
  - [ ] Validate honeypot (must be empty)
  - [ ] Sanitize all inputs (htmlspecialchars)

- [ ] CSRF protection
  - [ ] Generate CSRF token on page load
  - [ ] Store token in session
  - [ ] Validate token on submission
  - [ ] Return error if invalid

- [ ] Rate limiting
  - [ ] Track submissions by IP address
  - [ ] Max 3 submissions per IP per hour
  - [ ] Store in session or temp file
  - [ ] Return error if limit exceeded

- [ ] Brevo API integration
  - [ ] Include Brevo PHP library (via cURL)
  - [ ] Create contact in Brevo
  - [ ] Add contact to list
  - [ ] Set contact attributes (name, timestamp)
  - [ ] Handle API errors gracefully

- [ ] Response handling
  - [ ] Return JSON response
  - [ ] Success: {success: true, message: "..."}
  - [ ] Error: {success: false, error: "..."}
  - [ ] Log errors to file (optional)

#### Brevo API Integration
- [ ] Create api/brevo.php (helper class)
  - [ ] Function: addContact($email, $name)
  - [ ] Function: updateContact($email, $attributes)
  - [ ] Function: sendTransactionalEmail($to, $subject, $html)
  - [ ] Error handling
  - [ ] cURL implementation

- [ ] Test Brevo API
  - [ ] Test adding contact
  - [ ] Test updating contact
  - [ ] Test sending email
  - [ ] Verify contacts appear in Brevo dashboard

#### Optional: Double Opt-In
- [ ] Create api/verify.php (if DOI enabled)
  - [ ] Validate verification token
  - [ ] Update Brevo contact (DOI_CONFIRMED=true)
  - [ ] Trigger email sequence
  - [ ] Redirect to success page

- [ ] Modify submit.php (if DOI enabled)
  - [ ] Generate verification token
  - [ ] Add contact with DOI_PENDING=true
  - [ ] Send verification email
  - [ ] Return success message

#### Security
- [ ] Create .htaccess
  - [ ] Deny access to config.php
  - [ ] Deny access to .git/
  - [ ] Force HTTPS (if available)
  - [ ] Set security headers

- [ ] Error handling
  - [ ] Don't expose sensitive data in errors
  - [ ] Log errors to file
  - [ ] Return generic error messages to user

### Acceptance Criteria
- ✅ Form submission works (server-side)
- ✅ Input validation works (server-side)
- ✅ CSRF protection implemented
- ✅ Rate limiting works
- ✅ Brevo API integration works
- ✅ Contacts added to Brevo successfully
- ✅ Security measures implemented
- ✅ Error handling works correctly

---

## 🎯 Milestone 4: Testing & Deployment (Day 6)

**Goal:** Test thoroughly and deploy to IONOS  
**Status:** ⏳ Pending  
**Due:** 2026-03-09

### Tasks

#### Local Testing
- [ ] Test form validation (client-side)
  - [ ] Test empty fields
  - [ ] Test invalid email
  - [ ] Test unchecked checkboxes
  - [ ] Test valid submission

- [ ] Test form submission (server-side)
  - [ ] Test with valid data
  - [ ] Test with invalid data
  - [ ] Test CSRF protection
  - [ ] Test rate limiting
  - [ ] Test honeypot

- [ ] Test Brevo integration
  - [ ] Submit test form
  - [ ] Verify contact in Brevo
  - [ ] Verify email sequence triggered
  - [ ] Check email delivery

- [ ] Test responsive design
  - [ ] Test on iPhone (Safari)
  - [ ] Test on Android (Chrome)
  - [ ] Test on iPad
  - [ ] Test on desktop (Chrome, Firefox, Safari)

- [ ] Test legal pages
  - [ ] Verify all links work
  - [ ] Verify content is correct
  - [ ] Verify mobile responsive

#### Brevo Setup
- [ ] Create Brevo account (if not exists)
  - [ ] Sign up for free tier
  - [ ] Verify email address

- [ ] Configure Brevo
  - [ ] Generate API key
  - [ ] Create contact list
  - [ ] Verify sender email
  - [ ] Create email templates (3-5)
  - [ ] Set up automation workflow

- [ ] Test email sequence
  - [ ] Add test contact
  - [ ] Verify Email 1 received
  - [ ] Verify Email 2 received (after delay)
  - [ ] Verify Email 3 received (after delay)
  - [ ] Check email formatting
  - [ ] Check unsubscribe link works

#### IONOS Deployment
- [ ] Prepare for deployment
  - [ ] Create config.php with production values
  - [ ] Test all functionality locally
  - [ ] Create deployment checklist

- [ ] FTP upload to IONOS
  - [ ] Upload public/ folder to web root
  - [ ] Set file permissions (644 for files)
  - [ ] Set directory permissions (755 for dirs)
  - [ ] Verify .htaccess uploaded

- [ ] Configure IONOS
  - [ ] Verify PHP 7.4+ enabled
  - [ ] Enable HTTPS/SSL
  - [ ] Test domain access

- [ ] Production testing
  - [ ] Test form submission
  - [ ] Verify Brevo integration
  - [ ] Test on mobile devices
  - [ ] Test all pages load correctly
  - [ ] Verify HTTPS works

#### Performance Testing
- [ ] Test page load speed
  - [ ] Target: < 2 seconds
  - [ ] Use Google PageSpeed Insights
  - [ ] Optimize if needed

- [ ] Test form submission speed
  - [ ] Target: < 3 seconds
  - [ ] Test Brevo API response time

### Acceptance Criteria
- ✅ All local tests pass
- ✅ Brevo integration fully configured
- ✅ Email sequence tested and working
- ✅ Deployed to IONOS successfully
- ✅ Production testing complete
- ✅ Performance targets met
- ✅ No errors in production

---

## 🎯 Milestone 5: Documentation & Handoff (Day 7)

**Goal:** Complete documentation and hand off to client  
**Status:** ⏳ Pending  
**Due:** 2026-03-10

### Tasks

#### Developer Documentation
- [ ] Update README.md
  - [ ] Add final setup instructions
  - [ ] Add troubleshooting section
  - [ ] Add API documentation
  - [ ] Add deployment instructions

- [ ] Update PLANNING.md
  - [ ] Mark completed sections
  - [ ] Add lessons learned
  - [ ] Add future enhancement ideas

- [ ] Update TASK.md
  - [ ] Mark all tasks complete
  - [ ] Add final notes

- [ ] Create CONTRIBUTING.md
  - [ ] Code style guidelines
  - [ ] Git workflow
  - [ ] Testing requirements

#### Client Documentation (German)
- [ ] Create docs/BENUTZERHANDBUCH.md (User Manual)
  - [ ] How to access Brevo dashboard
  - [ ] How to view contacts
  - [ ] How to edit email templates
  - [ ] How to view analytics
  - [ ] How to export contacts
  - [ ] How to add/remove from list

- [ ] Create docs/TROUBLESHOOTING.md
  - [ ] Common issues and solutions
  - [ ] Contact information for support
  - [ ] FAQ section

- [ ] Update Impressum & Datenschutz
  - [ ] Replace placeholders with real data
  - [ ] Client name, address, contact
  - [ ] Verify legal compliance

#### Final Testing
- [ ] Complete end-to-end test
  - [ ] Submit form as user
  - [ ] Verify email received
  - [ ] Verify sequence continues
  - [ ] Test unsubscribe

- [ ] Client review
  - [ ] Demonstrate all features
  - [ ] Walk through Brevo dashboard
  - [ ] Answer questions
  - [ ] Get approval

#### Handoff
- [ ] Provide access credentials
  - [ ] IONOS FTP credentials
  - [ ] Brevo account access
  - [ ] Git repository access

- [ ] Training session
  - [ ] Show how to update email templates
  - [ ] Show how to view analytics
  - [ ] Show how to export contacts
  - [ ] Show how to troubleshoot

- [ ] Final delivery
  - [ ] All documentation
  - [ ] Source code (Git repository)
  - [ ] Access credentials
  - [ ] Support contact information

### Acceptance Criteria
- ✅ All documentation complete
- ✅ Client manual in German
- ✅ Client trained on Brevo
- ✅ All credentials provided
- ✅ Client approval received
- ✅ Project officially handed off

---

## 🔄 Backlog (Future Enhancements)

### Discovered During Work
- [ ] Add analytics tracking (Google Analytics)
- [ ] Add UTM parameters to email links
- [ ] Create admin dashboard for viewing submissions
- [ ] Add reCAPTCHA for advanced spam protection
- [ ] Add multi-language support
- [ ] Add A/B testing for email templates

### Client Requests (To Be Added)
- [ ] Monthly newsletter automation
- [ ] SMS notifications via Brevo
- [ ] Custom email templates
- [ ] Advanced analytics dashboard

---

## 📊 Progress Tracking

### Overall Progress
- **Milestone 1:** 🔄 In Progress (20%)
- **Milestone 2:** ⏳ Pending (0%)
- **Milestone 3:** ⏳ Pending (0%)
- **Milestone 4:** ⏳ Pending (0%)
- **Milestone 5:** ⏳ Pending (0%)

### Time Tracking
| Milestone | Estimated | Actual | Status |
|-----------|-----------|--------|--------|
| M1: Planning & Setup | 1 day | 0.5 days | In Progress |
| M2: Frontend | 2 days | - | Pending |
| M3: Backend | 2 days | - | Pending |
| M4: Testing & Deployment | 1 day | - | Pending |
| M5: Documentation & Handoff | 1 day | - | Pending |
| **Total** | **7 days** | **0.5 days** | **7%** |

---

## 🐛 Known Issues

### Current Issues
- None yet

### Resolved Issues
- None yet

---

## 📝 Notes

### 2026-03-06
- Client provided logo files (SVG without background, PNG with white background)
- Font: The Seasons (serif typeface) - 6 OTF files extracted and placed in public/assets/fonts/
- Domain: teammehrwert.info (IONOS)
- Email: Office@teammehrwert.info
- Form fields updated: Vorname, Name, Email, Mobilfunknummer, Mentor
- Design: Clean, minimalist
- Access: Private link only (not publicly posted)
- Brevo account not yet created by client

### 2026-03-04
- Created PLANNING.md with complete architecture
- Started TASK.md creation
- Decided to skip double opt-in unless legally required (users only access via unique link)
- Reference project: `/home/nop/CascadeProjects/CRM-Funnel-Prototype-main`
- Client has domain and email already set up

### Design Decisions
- **No Double Opt-In (initially):** Since users only access the page via a unique link, double opt-in may not be legally required. Can be added later if needed.
- **No Database:** Brevo stores all contacts, no need for local database
- **TailwindCSS via CDN:** No build process needed, works directly on IONOS
- **PHP Only:** IONOS doesn't support Node.js, so pure PHP backend

### Questions for Client
- [x] Do you want double opt-in email verification? **No - private link access only**
- [ ] What should the email sequence contain? (we can use placeholders initially)
- [ ] Do you have Brevo account already, or should we create one? **Not yet created**
- [ ] What are the exact details for Impressum? (name, address, contact)
- [ ] Do you want analytics tracking?
- [ ] What is the purpose of the "Mentor" field? (for email personalization or segmentation?)

---

## ✅ Definition of Done

### For Each Task
- ✅ Code written and tested
- ✅ Code documented with comments
- ✅ Git commit with descriptive message
- ✅ No errors or warnings
- ✅ Works on mobile and desktop
- ✅ Meets acceptance criteria

### For Each Milestone
- ✅ All tasks completed
- ✅ Acceptance criteria met
- ✅ Tested thoroughly
- ✅ Documentation updated
- ✅ Git commit and push
- ✅ Client review (if applicable)

---

**Last Updated:** 2026-03-04  
**Next Review:** After Milestone 1 completion
