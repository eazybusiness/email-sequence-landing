# Brevo Setup Guide

Complete guide for setting up Brevo email automation for the Email Sequence Landing Page.

---

## 📋 Overview

Brevo (formerly Sendinblue) is an email marketing platform that provides:
- ✅ Free tier: 300 emails/day, unlimited contacts
- ✅ Email automation workflows
- ✅ Transactional emails
- ✅ Contact management
- ✅ Analytics and reporting

---

## 🚀 Step 1: Create Brevo Account

1. **Sign Up**
   - Go to: https://www.brevo.com/
   - Click "Sign up free"
   - Enter email and create password
   - Verify email address

2. **Complete Profile**
   - Company name
   - Industry
   - Number of contacts
   - Use case: "Email Marketing"

3. **Verify Email**
   - Check inbox for verification email
   - Click verification link

---

## 🔑 Step 2: Generate API Key

1. **Access API Settings**
   - Login to Brevo
   - Go to: Settings → SMTP & API → API Keys

2. **Create New API Key**
   - Click "Generate a new API key"
   - Name: "Email Sequence Landing Page"
   - Click "Generate"

3. **Copy API Key**
   - Copy the key (starts with `xkeysib-...`)
   - **Important:** Save it securely, you won't see it again!

4. **Add to config.php**
   ```php
   define('BREVO_API_KEY', 'xkeysib-your-api-key-here');
   ```

---

## 📧 Step 3: Verify Sender Email

1. **Go to Senders & IP**
   - Settings → Senders & IP

2. **Add Sender Email**
   - Click "Add a sender"
   - Email: `noreply@yourdomain.com`
   - Name: "Your Company Name"
   - Click "Add"

3. **Verify Email**
   - Check inbox of sender email
   - Click verification link
   - Wait for approval (usually instant)

4. **Update config.php**
   ```php
   define('BREVO_SENDER_EMAIL', 'noreply@yourdomain.com');
   define('BREVO_SENDER_NAME', 'Your Company Name');
   ```

---

## 📋 Step 4: Create Contact List

1. **Go to Contacts**
   - Contacts → Lists

2. **Create New List**
   - Click "Create a list"
   - Name: "Email Sequence Subscribers"
   - Folder: Default (or create new)
   - Click "Create"

3. **Note List ID**
   - Click on the list
   - Look at URL: `.../lists/2` (2 is the list ID)
   - Or check list settings

4. **Update config.php**
   ```php
   define('BREVO_LIST_ID', 2); // Your actual list ID
   ```

---

## ✉️ Step 5: Create Email Templates

### Template 1: Welcome Email (Day 0)

1. **Go to Campaigns**
   - Campaigns → Templates

2. **Create Template**
   - Click "Create a template"
   - Choose "Drag & Drop Editor" or "Rich Text Editor"

3. **Design Email**
   ```
   Subject: Willkommen! Hier ist dein Zugang
   
   Hallo {{ contact.FIRSTNAME }},
   
   vielen Dank für deine Anmeldung!
   
   In den nächsten Tagen erhältst du wertvolle Informationen von uns.
   
   Bleib gespannt!
   
   Viele Grüße
   Dein Team
   
   ---
   Du möchtest keine E-Mails mehr erhalten? {{ unsubscribe }}
   ```

4. **Save Template**
   - Name: "Email 1 - Welcome"
   - Click "Save"

### Template 2: Value Email #1 (Day 2-3)

```
Subject: [Benefit/Value Proposition]

Hallo {{ contact.FIRSTNAME }},

[Content about value/benefit #1]

[Call to action]

Viele Grüße
Dein Team

---
{{ unsubscribe }}
```

### Template 3: Value Email #2 (Day 4-5)

```
Subject: [Another Benefit]

Hallo {{ contact.FIRSTNAME }},

[Content about value/benefit #2]

[Call to action]

Viele Grüße
Dein Team

---
{{ unsubscribe }}
```

### Template 4: Call to Action (Day 7)

```
Subject: [Main Offer/CTA]

Hallo {{ contact.FIRSTNAME }},

[Main offer or call to action]

[Link to product/service]

Viele Grüße
Dein Team

---
{{ unsubscribe }}
```

### Template 5: Follow-up (Day 14) - Optional

```
Subject: [Follow-up Message]

Hallo {{ contact.FIRSTNAME }},

[Follow-up content]

[Secondary CTA]

Viele Grüße
Dein Team

---
{{ unsubscribe }}
```

---

## 🤖 Step 6: Create Automation Workflow

1. **Go to Automation**
   - Automation → Create an automation

2. **Choose Trigger**
   - Trigger: "Contact added to list"
   - Select your list: "Email Sequence Subscribers"

3. **Add Email Actions**

   **Email 1: Immediate**
   - Add action: "Send email"
   - Select template: "Email 1 - Welcome"
   - Delay: 0 minutes

   **Email 2: After 2 days**
   - Add action: "Wait"
   - Duration: 2 days
   - Add action: "Send email"
   - Select template: "Email 2 - Value #1"

   **Email 3: After 4 days**
   - Add action: "Wait"
   - Duration: 2 days (cumulative: 4 days)
   - Add action: "Send email"
   - Select template: "Email 3 - Value #2"

   **Email 4: After 7 days**
   - Add action: "Wait"
   - Duration: 3 days (cumulative: 7 days)
   - Add action: "Send email"
   - Select template: "Email 4 - CTA"

   **Email 5: After 14 days (Optional)**
   - Add action: "Wait"
   - Duration: 7 days (cumulative: 14 days)
   - Add action: "Send email"
   - Select template: "Email 5 - Follow-up"

4. **Configure Settings**
   - Name: "Email Sequence Automation"
   - Status: Active
   - Click "Save and activate"

---

## 🧪 Step 7: Test the Workflow

1. **Add Test Contact**
   - Go to Contacts → Add a contact
   - Email: your-test-email@gmail.com
   - First name: Test
   - Add to list: "Email Sequence Subscribers"

2. **Verify Email 1**
   - Check inbox immediately
   - Verify welcome email received
   - Check formatting and links

3. **Monitor Automation**
   - Go to Automation → Your workflow
   - Click "Statistics"
   - Verify contact entered workflow

4. **Wait for Subsequent Emails**
   - Email 2 should arrive in 2 days
   - Email 3 should arrive in 4 days
   - etc.

5. **Test Unsubscribe**
   - Click unsubscribe link in email
   - Verify contact is unsubscribed
   - Verify no more emails received

---

## 📊 Step 8: Configure Analytics

1. **Enable Tracking**
   - Settings → Tracking
   - Enable "Open tracking"
   - Enable "Click tracking"

2. **View Reports**
   - Go to Automation → Your workflow → Statistics
   - View:
     - Emails sent
     - Open rate
     - Click rate
     - Unsubscribe rate

3. **Export Data**
   - Go to Contacts → Lists → Your list
   - Click "Export"
   - Choose format: CSV or Excel
   - Download contacts

---

## 🔧 Advanced Configuration

### Custom Contact Attributes

Add custom fields to contacts:

1. **Go to Contacts → Settings**
2. **Add Attribute**
   - Name: `SIGNUP_DATE`
   - Type: Date
   - Use in automation

3. **Update in PHP**
   ```php
   // In api/brevo.php
   $attributes = [
       'FIRSTNAME' => $name,
       'SIGNUP_DATE' => date('Y-m-d'),
   ];
   ```

### Conditional Workflows

Add conditions to workflow:

1. **Add Condition**
   - In workflow, add "If/Else" action
   - Condition: e.g., "Contact attribute SIGNUP_DATE is before..."
   - Different email paths based on condition

### A/B Testing

Test different email versions:

1. **Create A/B Test**
   - In automation, add "A/B test" action
   - Create 2 versions of email
   - Split: 50/50
   - Track which performs better

---

## 🔒 DSGVO Compliance

### Required Elements

1. **Unsubscribe Link**
   - Automatically added by Brevo
   - Use `{{ unsubscribe }}` placeholder
   - Required in every email

2. **Privacy Policy Link**
   - Add to email footer:
   ```
   Datenschutz: https://yourdomain.com/datenschutz.html
   Impressum: https://yourdomain.com/impressum.html
   ```

3. **Data Processing Agreement**
   - Brevo provides GDPR-compliant DPA
   - Go to Settings → GDPR
   - Download and sign if required

### Contact Rights

Users can request:
- **Access**: Export their data
- **Deletion**: Remove from list
- **Correction**: Update their data

Handle requests via Brevo dashboard:
- Contacts → Search contact → Edit or Delete

---

## 🆘 Troubleshooting

### Issue: API Key Not Working

**Solutions:**
- Verify API key is correct (starts with `xkeysib-`)
- Check API key has correct permissions
- Regenerate API key if needed

### Issue: Emails Not Sending

**Solutions:**
- Verify sender email is verified
- Check automation workflow is active
- Verify contact was added to correct list
- Check Brevo account status (not suspended)

### Issue: Emails Going to Spam

**Solutions:**
- Verify sender email domain (use your own domain)
- Add SPF and DKIM records (Brevo provides these)
- Avoid spam trigger words
- Include unsubscribe link
- Don't send too frequently

### Issue: Low Open Rates

**Solutions:**
- Improve subject lines
- Send at optimal times (test different times)
- Segment your list
- Clean inactive contacts

---

## 📈 Best Practices

### Email Content
- ✅ Personalize with `{{ contact.FIRSTNAME }}`
- ✅ Keep subject lines short (< 50 chars)
- ✅ Use clear call-to-action
- ✅ Mobile-friendly design
- ✅ Include unsubscribe link

### Sending Schedule
- ✅ Don't send too frequently (max 1-2 per week)
- ✅ Send at optimal times (10am-2pm works well)
- ✅ Avoid weekends (unless B2C)
- ✅ Test different times

### List Management
- ✅ Clean list regularly (remove bounces)
- ✅ Segment based on engagement
- ✅ Re-engage inactive contacts
- ✅ Remove unengaged after 6 months

---

## 📞 Brevo Support

### Resources
- **Help Center**: https://help.brevo.com/
- **API Documentation**: https://developers.brevo.com/
- **Community Forum**: https://community.brevo.com/
- **Email Support**: support@brevo.com

### Useful Links
- **API Status**: https://status.brevo.com/
- **Pricing**: https://www.brevo.com/pricing/
- **Templates**: https://www.brevo.com/email-templates/

---

## 📝 Checklist

- [ ] Brevo account created
- [ ] Email verified
- [ ] API key generated and saved
- [ ] Sender email verified
- [ ] Contact list created
- [ ] List ID noted
- [ ] Email templates created (3-5)
- [ ] Automation workflow created
- [ ] Workflow activated
- [ ] Test contact added
- [ ] Test emails received
- [ ] Unsubscribe tested
- [ ] Analytics configured
- [ ] DSGVO compliance verified

---

**Last Updated:** 2026-03-04  
**Version:** 1.0.0
