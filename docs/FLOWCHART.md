# Process Flowcharts

Visual representation of the Email Sequence Landing Page workflows.

---

## 📊 User Flow Diagram

### Standard Flow (Without Double Opt-In)

```
┌─────────────────────────────────────────────────────────────────┐
│                     USER RECEIVES UNIQUE LINK                    │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                  OPENS LANDING PAGE (index.html)                 │
│  - Sees headline and description                                 │
│  - Sees contact form                                             │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                    FILLS OUT CONTACT FORM                        │
│  - Name (required)                                               │
│  - Email (required)                                              │
│  - Privacy policy checkbox (required)                            │
│  - Email marketing consent checkbox (required)                   │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              JAVASCRIPT VALIDATES INPUT (form.js)                │
│  - Name: min 2 chars                                             │
│  - Email: RFC 5322 format                                        │
│  - Checkboxes: both must be checked                              │
│  - Honeypot: must be empty                                       │
└─────────────────┬───────────────────────────────────────────────┘
                  │
                  ├─── Invalid ──┐
                  │              ▼
                  │         ┌─────────────────────────────────────┐
                  │         │  SHOW INLINE ERROR MESSAGES         │
                  │         │  User corrects and resubmits        │
                  │         └──────────────┬──────────────────────┘
                  │                        │
                  │◄───────────────────────┘
                  │
                  ▼ Valid
┌─────────────────────────────────────────────────────────────────┐
│              AJAX POST TO api/submit.php                         │
│  - Shows loading state                                           │
│  - Disables submit button                                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│           PHP VALIDATES INPUT (submit.php)                       │
│  - CSRF token validation                                         │
│  - Rate limiting check (3 per IP per hour)                       │
│  - Honeypot check                                                │
│  - Server-side validation (name, email)                          │
│  - Input sanitization                                            │
└─────────────────┬───────────────────────────────────────────────┘
                  │
                  ├─── Invalid/Error ──┐
                  │                    ▼
                  │         ┌─────────────────────────────────────┐
                  │         │  RETURN JSON ERROR                  │
                  │         │  {success: false, error: "..."}     │
                  │         └──────────────┬──────────────────────┘
                  │                        │
                  │                        ▼
                  │         ┌─────────────────────────────────────┐
                  │         │  JAVASCRIPT SHOWS ERROR MESSAGE     │
                  │         │  User can retry                     │
                  │         └─────────────────────────────────────┘
                  │
                  ▼ Valid
┌─────────────────────────────────────────────────────────────────┐
│              CALL BREVO API (brevo.php)                          │
│  POST /v3/contacts                                               │
│  - Add contact to list                                           │
│  - Set attributes: FIRSTNAME, SIGNUP_DATE                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ├─── API Error ──┐
                      │                ▼
                      │         ┌─────────────────────────────────┐
                      │         │  LOG ERROR & RETURN JSON ERROR  │
                      │         └─────────────────────────────────┘
                      │
                      ▼ Success
┌─────────────────────────────────────────────────────────────────┐
│              BREVO AUTOMATION TRIGGERED                          │
│  - Contact added to list                                         │
│  - Automation workflow starts                                    │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL SEQUENCE BEGINS                               │
│  Email 1: Immediate (Welcome)                                    │
│  Email 2: Day 2-3 (Value #1)                                     │
│  Email 3: Day 4-5 (Value #2)                                     │
│  Email 4: Day 7 (Call to Action)                                 │
│  Email 5: Day 14 (Follow-up) - Optional                          │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              RETURN JSON SUCCESS                                 │
│  {success: true, message: "Thank you!"}                          │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              JAVASCRIPT SHOWS SUCCESS MESSAGE                    │
│  - Hide form                                                     │
│  - Show success message                                          │
│  - Optional: Redirect to success.html                            │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🔄 Optional: Double Opt-In Flow

```
┌─────────────────────────────────────────────────────────────────┐
│              USER SUBMITS FORM (as above)                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              PHP GENERATES VERIFICATION TOKEN                    │
│  - Random token: hash(email + timestamp + secret)                │
│  - Store in session or database                                  │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              ADD CONTACT TO BREVO                                │
│  - Set attribute: DOI_PENDING=true                               │
│  - Set attribute: DOI_TOKEN=token                                │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              SEND VERIFICATION EMAIL                             │
│  Subject: "Please confirm your email"                            │
│  Body: "Click here to confirm: [verification link]"              │
│  Link: https://domain.com/api/verify.php?token=xxx               │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              USER RECEIVES EMAIL                                 │
│  - Opens email                                                   │
│  - Clicks verification link                                      │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              VERIFY.PHP VALIDATES TOKEN                          │
│  - Check token exists                                            │
│  - Check token not expired (24 hours)                            │
│  - Check not already verified                                    │
└─────────────────┬───────────────────────────────────────────────┘
                  │
                  ├─── Invalid ──┐
                  │              ▼
                  │         ┌─────────────────────────────────────┐
                  │         │  SHOW ERROR PAGE                    │
                  │         │  "Invalid or expired link"          │
                  │         └─────────────────────────────────────┘
                  │
                  ▼ Valid
┌─────────────────────────────────────────────────────────────────┐
│              UPDATE BREVO CONTACT                                │
│  PUT /v3/contacts/{email}                                        │
│  - Set DOI_CONFIRMED=true                                        │
│  - Remove DOI_PENDING                                            │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              BREVO AUTOMATION TRIGGERED                          │
│  - Trigger: DOI_CONFIRMED=true                                   │
│  - Email sequence begins                                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              REDIRECT TO SUCCESS PAGE                            │
│  - Show "Email confirmed!" message                               │
│  - Show "You'll receive emails soon"                             │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📧 Email Sequence Flow

```
┌─────────────────────────────────────────────────────────────────┐
│              CONTACT ADDED TO BREVO LIST                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              AUTOMATION WORKFLOW STARTS                          │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL 1: WELCOME (Day 0)                            │
│  Sent: Immediately                                               │
│  Subject: "Willkommen! Hier ist dein Zugang"                     │
│  Content: Welcome message, set expectations                      │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              WAIT 2 DAYS                                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL 2: VALUE #1 (Day 2-3)                         │
│  Sent: After 2 days                                              │
│  Subject: "[Benefit/Value Proposition]"                          │
│  Content: First value proposition, build trust                   │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              WAIT 2 DAYS                                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL 3: VALUE #2 (Day 4-5)                         │
│  Sent: After 4 days total                                        │
│  Subject: "[Another Benefit]"                                    │
│  Content: Second value proposition, deepen engagement            │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              WAIT 3 DAYS                                         │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL 4: CALL TO ACTION (Day 7)                     │
│  Sent: After 7 days total                                        │
│  Subject: "[Main Offer/CTA]"                                     │
│  Content: Main offer, clear call to action                       │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              WAIT 7 DAYS (Optional)                              │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              EMAIL 5: FOLLOW-UP (Day 14) - Optional              │
│  Sent: After 14 days total                                       │
│  Subject: "[Follow-up Message]"                                  │
│  Content: Follow-up, secondary CTA                               │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              SEQUENCE COMPLETE                                   │
│  - User can unsubscribe anytime                                  │
│  - Monthly emails can continue (if configured)                   │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🔐 Security Flow

```
┌─────────────────────────────────────────────────────────────────┐
│              USER LOADS PAGE (index.html)                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              PHP GENERATES CSRF TOKEN                            │
│  - Random token stored in session                                │
│  - Token embedded in form as hidden field                        │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              USER SUBMITS FORM                                   │
│  - CSRF token included in POST data                              │
│  - Honeypot field included (should be empty)                     │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│              SECURITY CHECKS (submit.php)                        │
│  1. Validate CSRF token                                          │
│  2. Check rate limiting (IP-based)                               │
│  3. Check honeypot field (must be empty)                         │
│  4. Validate input (sanitize, type check)                        │
└─────────────────┬───────────────────────────────────────────────┘
                  │
                  ├─── Failed ──┐
                  │             ▼
                  │         ┌─────────────────────────────────────┐
                  │         │  REJECT REQUEST                     │
                  │         │  - Log attempt                      │
                  │         │  - Return generic error             │
                  │         │  - Don't reveal security details    │
                  │         └─────────────────────────────────────┘
                  │
                  ▼ Passed
┌─────────────────────────────────────────────────────────────────┐
│              PROCESS REQUEST SAFELY                              │
│  - All inputs sanitized                                          │
│  - API calls use secure methods                                  │
│  - Errors logged, not exposed                                    │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📊 Data Flow Diagram

```
┌──────────────┐
│   Browser    │
│  (User)      │
└──────┬───────┘
       │
       │ 1. GET index.html
       ▼
┌──────────────────────────────────────┐
│   IONOS Web Server                   │
│   - Serves static HTML/CSS/JS        │
│   - Generates CSRF token             │
└──────┬───────────────────────────────┘
       │
       │ 2. HTML + CSRF token
       ▼
┌──────────────┐
│   Browser    │
│  - Renders   │
│  - Validates │
└──────┬───────┘
       │
       │ 3. POST /api/submit.php
       │    {name, email, csrf_token}
       ▼
┌──────────────────────────────────────┐
│   submit.php                         │
│   - Validates CSRF                   │
│   - Validates input                  │
│   - Checks rate limit                │
└──────┬───────────────────────────────┘
       │
       │ 4. Add contact
       │    POST /v3/contacts
       ▼
┌──────────────────────────────────────┐
│   Brevo API                          │
│   - Stores contact                   │
│   - Triggers automation              │
└──────┬───────────────────────────────┘
       │
       │ 5. Success response
       ▼
┌──────────────────────────────────────┐
│   submit.php                         │
│   - Returns JSON success             │
└──────┬───────────────────────────────┘
       │
       │ 6. JSON response
       ▼
┌──────────────┐
│   Browser    │
│  - Shows     │
│    success   │
└──────────────┘
       │
       │ 7. Email sequence
       ▼
┌──────────────────────────────────────┐
│   Brevo Automation                   │
│   - Sends Email 1 (immediate)        │
│   - Waits 2 days                     │
│   - Sends Email 2                    │
│   - Waits 2 days                     │
│   - Sends Email 3                    │
│   - etc.                             │
└──────┬───────────────────────────────┘
       │
       │ 8. Emails delivered
       ▼
┌──────────────┐
│   User       │
│   Inbox      │
└──────────────┘
```

---

## 🗂️ File Structure Flow

```
User Request
     │
     ▼
┌─────────────────────────────────────┐
│  index.html                         │
│  - Main landing page                │
│  - Includes form                    │
│  - Loads CSS/JS                     │
└─────────────┬───────────────────────┘
              │
              ├──► css/style.css (styling)
              │
              └──► js/form.js (validation)
                        │
                        │ AJAX POST
                        ▼
              ┌─────────────────────────┐
              │  api/submit.php         │
              │  - Main form handler    │
              └─────────┬───────────────┘
                        │
                        ├──► api/config.php (settings)
                        │
                        └──► api/brevo.php (API helper)
                                  │
                                  │ API Call
                                  ▼
                            ┌──────────────┐
                            │  Brevo API   │
                            └──────────────┘
```

---

## 🎯 Decision Flow

```
Form Submitted
     │
     ▼
Is CSRF valid? ──No──► Return Error 403
     │
     │ Yes
     ▼
Is rate limit OK? ──No──► Return Error 429
     │
     │ Yes
     ▼
Is honeypot empty? ──No──► Return Error (silent)
     │
     │ Yes
     ▼
Is input valid? ──No──► Return Error 400
     │
     │ Yes
     ▼
Call Brevo API
     │
     ├──► Success ──► Return Success 200
     │
     └──► Error ──► Log & Return Error 500
```

---

**Last Updated:** 2026-03-04  
**Version:** 1.0.0
