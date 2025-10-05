# WooCommerce Developer Interview Guide

This guide helps you conduct effective technical interviews using this environment.

---

## Before the Interview

### 1-2 Weeks Before:
- [ ] Create LocalWP export (see instructions below)
- [ ] Push wp-content to Git repository
- [ ] Upload LocalWP .zip to Dropbox/Google Drive/WeTransfer
- [ ] Test both Docker and LocalWP setups yourself

### 3-5 Days Before:
- [ ] Send setup email to candidate (use `CANDIDATE_EMAIL_TEMPLATE.md`)
- [ ] Confirm they received the email and links work

### 1 Day Before:
- [ ] Send reminder email
- [ ] Ask them to confirm setup is working
- [ ] Prepare your interview questions (see `interview-exercises/` folder)

---

## Creating the LocalWP Export

**If you want to offer LocalWP option (recommended):**

1. **Install LocalWP**
   - Download from https://localwp.com/

2. **Create new site**
   - Click "+" → "Create a new site"
   - Site name: "WooCommerce Interview"
   - Choose "Preferred" environment
   - WordPress username: `admin`, password: `admin`

3. **Install WooCommerce**
   - Open WP Admin
   - Go to Plugins → Add New
   - Install and activate WooCommerce
   - Skip the setup wizard

4. **Install Storefront theme**
   - Go to Appearance → Themes → Add New
   - Search for "Storefront"
   - Install and activate

5. **Add your custom files**
   - Right-click site → "Open site shell"
   - Navigate to `wp-content/`
   - Copy in your `themes/interview-theme/` folder
   - Copy in your `plugins/interview-plugin/` folder
   - Or use SFTP/direct file access

6. **Activate custom theme & plugin**
   - Appearance → Themes → Activate "Interview Theme"
   - Plugins → Activate "Interview Plugin"

7. **Optional: Add sample products**
   - Create 3-5 sample products manually or via WP-CLI in Local's shell

8. **Export the site**
   - Right-click site in LocalWP
   - Choose "Export"
   - Wait for .zip file to generate
   - Upload to file sharing service (Dropbox, Google Drive, etc.)
   - Get shareable link

9. **Test the export**
   - Import it into LocalWP on a different machine or folder
   - Verify everything works

---

## Interview Structure (60-90 minutes)

### Part 1: Introduction (5-10 min)
- Brief overview of their background
- Ask about their WooCommerce experience
- Confirm their environment is running

**Warmup question:**
"Show me your development environment. Can you navigate to the functions.php file and show me you can edit it?"

---

### Part 2: Rapid-Fire Questions (10-15 min)

Choose 5-10 questions from `interview-exercises/rapid-fire-questions.md`

**Focus areas:**
- WooCommerce architecture (hooks, filters, product types)
- Performance and best practices
- Common gotchas

**What you're testing:**
- Depth of knowledge
- Speed of recall
- Confidence vs. guessing

**Scoring:**
- 8-10 correct = Expert
- 5-7 correct = Strong mid-level
- 3-4 correct = Junior with experience
- <3 correct = Insufficient knowledge

---

### Part 3: Code Reading Challenge (10 min)

Share screen and show them one of the broken code examples:
- `interview-exercises/broken-code-example-1.php`
- `interview-exercises/broken-code-example-2.php`
- `interview-exercises/broken-code-example-3.php`

**Instructions:**
"I'm going to show you some code a previous developer wrote. The client says it's not working correctly. Without running it, tell me what issues you see and how they would manifest in production."

**What you're testing:**
- Can they spot bugs by reading?
- Do they understand context (hooks, WooCommerce APIs)?
- Do they think about edge cases?
- Security awareness?

**Expert behavior:**
- Spots 3+ issues within 2 minutes
- Explains *why* it's wrong, not just *that* it's wrong
- Mentions security concerns (XSS, CSRF, sanitization)

**Red flags:**
- "Looks fine to me"
- Only spots surface-level issues
- Can't explain what would happen in production

---

### Part 4: Live Coding Challenge (20-30 min)

Choose 1-2 challenges from `interview-exercises/live-coding-challenge.md`

**Recommended:**
- Challenge 1 (Cart Fee) - good for mid-level
- Challenge 2 (Custom Product Tab) - good for senior
- Challenge 3 (Custom Order Status) - good for expert

**Instructions:**
"I'm going to give you a business requirement. You can use AI tools, Google, documentation - whatever you'd normally use. I'm interested in your process, not memorization."

**What you're watching:**
1. **Problem comprehension:** Do they ask clarifying questions?
2. **Research approach:** WooCommerce docs, Stack Overflow, AI tools?
3. **Code quality:** Clean, well-commented, follows conventions?
4. **Testing:** Do they test as they go or at the end?
5. **AI usage:** Do they understand the code AI generates?

**Red flags:**
- 🚩 Copies large blocks from AI without reading
- 🚩 Can't explain their own code
- 🚩 Doesn't test anything
- 🚩 Gives up when first attempt doesn't work
- 🚩 Hardcodes values without explaining

**Green flags:**
- ✅ Tests incrementally
- ✅ Uses AI for boilerplate, edits thoughtfully
- ✅ Explains tradeoffs ("I could do X or Y...")
- ✅ Asks "what should happen if..."
- ✅ Comments complex parts
- ✅ Checks for edge cases

---

### Part 5: Architecture Discussion (10-15 min)

Give them a complex business requirement and ask them to whiteboard/talk through the approach.

**Example scenarios:**
1. **Custom Product Type:**
   "Client sells custom engraved products. Customers enter text, choose font, preview engraving. Engraving cost varies by character count. Orders must include all custom data. How would you build this?"

2. **Inventory Sync:**
   "Client has 5 physical stores with their own POS systems. Need to sync inventory to WooCommerce in real-time. How would you architect this?"

3. **Subscription Box:**
   "Client wants to sell subscription boxes. Customers pick 5 items from a catalog each month. Different pricing tiers. How would you build this?"

**What you're testing:**
- Systematic thinking
- Knowledge of WooCommerce extensibility
- Understanding of tradeoffs (custom code vs. plugins)
- Database and performance considerations
- Security and scalability awareness

**Expert behavior:**
- Asks clarifying questions first
- Discusses multiple approaches with pros/cons
- Mentions specific WooCommerce features/hooks
- Thinks about admin UX, not just front-end
- Considers edge cases and failure modes

**Red flags:**
- Jumps to code without planning
- "Just install a plugin for that"
- No mention of data storage strategy
- Doesn't consider admin/customer workflows

---

### Part 6: Debugging Exercise (Optional, 10 min)

If time permits, show them a deliberately broken WooCommerce site and have them diagnose.

**Common issues to create:**
- Product prices showing $0 (hook priority conflict)
- Checkout button doesn't work (JavaScript error)
- Orders stuck in Pending (payment callback broken)

**What you're watching:**
- Do they check browser console immediately?
- Do they know where WooCommerce logs are?
- Systematic approach vs. random guessing?
- Use of debugging tools (Query Monitor, etc.)?

---

## Scoring System

### Technical Knowledge (40 points)
- Rapid-fire questions: 20 points (2 pts each for 10 questions)
- Code reading: 10 points
- Architecture discussion: 10 points

### Practical Skills (40 points)
- Live coding: 30 points
  - Correct solution: 15 pts
  - Code quality: 10 pts
  - Testing & validation: 5 pts
- Debugging (if done): 10 points

### Soft Skills (20 points)
- Communication: 5 points
- Problem-solving approach: 5 points
- AI tool usage: 5 points
- Professionalism: 5 points

### Total: 100 points

**Hiring thresholds:**
- 85-100: Strong hire (expert level)
- 70-84: Hire (senior level)
- 55-69: Possible hire (mid-level, depends on needs)
- 40-54: Weak, consider junior role
- <40: Do not hire for WooCommerce role

---

## After the Interview

- [ ] Fill out scorecard immediately
- [ ] Note specific strengths and weaknesses
- [ ] If hiring, discuss next steps
- [ ] Send follow-up email within 24 hours

---

## Common Interview Mistakes to Avoid

**Don't:**
- ❌ Make it a "gotcha" interview (no trick questions)
- ❌ Expect memorization of function names (docs are fine)
- ❌ Penalize for using AI tools (it's 2024!)
- ❌ Focus only on code output (process matters more)
- ❌ Compare candidates to yourself (you wrote the questions!)

**Do:**
- ✅ Test real-world scenarios
- ✅ Allow time for thinking
- ✅ Ask "why" and "how" questions
- ✅ Be encouraging, not intimidating
- ✅ Focus on how they solve problems, not trivia

---

## Red Flags That Should Disqualify

- **Security ignorance:** Doesn't sanitize inputs, no awareness of XSS/CSRF
- **Can't explain their code:** Copies from AI/Stack Overflow without understanding
- **Edits core files:** Wants to modify WooCommerce plugin files directly
- **No testing:** Writes code but never runs it
- **Poor communication:** Can't explain their thinking process
- **Arrogant:** Dismissive of questions or best practices

---

## Questions Candidates Often Ask

**"Can I use Google/ChatGPT/AI tools?"**
→ Yes! Use whatever you'd normally use. We're testing real-world skills.

**"What version of WooCommerce is this?"**
→ Latest stable. Your code should work on recent versions.

**"Can I install additional plugins?"**
→ For the exercises, please use custom code. In real work, we can discuss plugin vs custom.

**"How much time do I have?"**
→ [Be specific, usually 15-20 min per coding challenge]

**"What if I don't finish?"**
→ That's okay! I'm more interested in your approach than completion.

---

Good luck with your interviews! 🚀
