# Candidate Email Template

Copy and customize this email to send to interview candidates.

---

**Subject:** Technical Interview Setup - WooCommerce Developer Position

---

Hi [CANDIDATE_NAME],

Thank you for your interest in the WooCommerce developer position! I'm looking forward to our technical interview on **[DATE]** at **[TIME]**.

## What to Prepare

Before our call, please set up a local WooCommerce development environment. You can choose whichever method you're most comfortable with:

### Option 1: LocalWP (Recommended - 5 minutes)
1. Install LocalWP: https://localwp.com/
2. Download the pre-configured site: **[YOUR_LOCALWP_ZIP_LINK]**
3. Import the .zip file into LocalWP
4. Start the site

### Option 2: Docker (10 minutes)
1. Clone this repository: **[YOUR_GIT_REPO_URL]**
2. Run: `./setup.sh`
3. Access at http://localhost:8080

### Option 3: Your Own Setup
If you have a preferred local dev environment (MAMP, Valet, etc.):
1. Install WordPress 6.x + WooCommerce
2. Clone wp-content from: **[YOUR_GIT_REPO_URL]**
3. Activate "Interview Theme" and "Interview Plugin"

Full setup instructions are in the README: **[YOUR_GIT_REPO_URL]**

## What You'll Need

During the interview:
- ✅ The WooCommerce site running locally
- ✅ Your preferred code editor (VS Code, PHPStorm, etc.)
- ✅ Screen sharing capability (Zoom/Meet/etc.)
- ✅ Access to your normal development tools

You'll be working primarily in:
- `wp-content/themes/interview-theme/functions.php`
- `wp-content/plugins/interview-plugin/interview-plugin.php`

## What to Expect

The interview will be approximately **[DURATION]** and will include:
- Brief discussion of your WooCommerce experience
- Code review and debugging exercises
- Live coding challenges
- Architecture and design questions

**Using AI tools (Claude Code, Copilot, ChatGPT, etc.) is encouraged!** I'm interested in seeing how you work with modern development tools, not testing memorization.

## Technical Requirements

Please verify before our call:
- [ ] Site loads in browser
- [ ] You can log into wp-admin (username: `admin`, password: `admin`)
- [ ] You can edit files in your IDE
- [ ] Screen sharing works

## Questions?

If you have any issues with the setup, please reach out **at least 24 hours before** our interview so we can troubleshoot.

Looking forward to seeing your work!

Best regards,
[YOUR_NAME]

---

**P.S.** Setup should take 5-15 minutes depending on which option you choose. If it's taking longer, something might be wrong - please let me know!
