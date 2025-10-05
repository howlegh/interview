# LocalWP Export Setup Guide

Follow these steps to create the LocalWP `.zip` file for candidates.

---

## Prerequisites

- **LocalWP installed** (download from https://localwp.com/)
- **15-20 minutes** for initial setup

---

## Step-by-Step Instructions

### 1. Create New Site in LocalWP

1. **Open LocalWP**
2. **Click the "+" button** (bottom left)
3. **Choose "Create a new site"**

### 2. Configure Site Settings

**Site Name:**
```
woocommerce-interview
```

**Environment:**
- Choose **"Preferred"**
- This will use recommended PHP/MySQL/Web Server versions

**WordPress Setup:**
- **WordPress Username:** `admin`
- **WordPress Password:** `admin`
- **WordPress Email:** `admin@example.com`

**Click "Add Site"** and wait for LocalWP to finish (1-2 minutes)

---

### 3. Start the Site

1. **Click "Start site"** in LocalWP (if not already started)
2. **Wait for green indicator** showing "Running"

---

### 4. Install WooCommerce

**Option A: Via WP Admin (Easier)**

1. **Click "WP Admin"** button in LocalWP
2. **Log in** (admin/admin)
3. **Go to:** Plugins → Add New
4. **Search:** "WooCommerce"
5. **Install and Activate** WooCommerce
6. **Skip the setup wizard** (click "Skip setup store" at the bottom)

**Option B: Via Site Shell (Faster)**

1. **Right-click site** in LocalWP → **"Open site shell"**
2. **Run:**
   ```bash
   wp plugin install woocommerce --activate
   wp option update woocommerce_task_list_hidden "yes"
   wp option update woocommerce_onboarding_opt_in "no"
   ```

---

### 5. Install Storefront Theme

**Option A: Via WP Admin**

1. **Go to:** Appearance → Themes → Add New
2. **Search:** "Storefront"
3. **Install and Activate** Storefront

**Option B: Via Site Shell**

```bash
wp theme install storefront --activate
```

---

### 6. Add Custom Theme & Plugin Files

You need to copy the files from this Git repo into the LocalWP site.

**Find the site folder:**
1. **Right-click site** in LocalWP
2. **Choose:** "Reveal in Finder" (Mac) or "Reveal in Explorer" (Windows)
3. **Navigate to:** `app/public/wp-content/`

**Copy files:**

```bash
# From your terminal, navigate to THIS repo folder
cd /path/to/interview

# Find your LocalWP site path (example below, yours will differ)
LOCALWP_PATH=~/Local\ Sites/woocommerce-interview/app/public/wp-content

# Copy the interview theme
cp -r wp-content/themes/interview-theme "$LOCALWP_PATH/themes/"

# Copy the interview plugin
cp -r wp-content/plugins/interview-plugin "$LOCALWP_PATH/plugins/"
```

**Or manually:**
- Copy `wp-content/themes/interview-theme/` → LocalWP site's `wp-content/themes/`
- Copy `wp-content/plugins/interview-plugin/` → LocalWP site's `wp-content/plugins/`

---

### 7. Activate Custom Theme & Plugin

**Via WP Admin:**

1. **Go to:** Appearance → Themes
2. **Activate:** "Interview Theme"
3. **Go to:** Plugins
4. **Activate:** "Interview Plugin"

**Via Site Shell:**

```bash
wp theme activate interview-theme
wp plugin activate interview-plugin
```

---

### 8. Configure WooCommerce (Optional but Recommended)

**Via Site Shell:**

```bash
# Set basic store details
wp option update woocommerce_store_address "123 Interview St"
wp option update woocommerce_store_city "Test City"
wp option update woocommerce_default_country "US:CA"
wp option update woocommerce_currency "USD"

# Set permalinks to pretty URLs
wp rewrite structure '/%postname%/' --hard

# Skip onboarding
wp option update woocommerce_task_list_hidden "yes"
wp option update woocommerce_onboarding_opt_in "no"
```

---

### 9. Add Sample Products (Optional)

**Option A: Via WP-CLI (Recommended)**

```bash
# In LocalWP site shell
wp wc product create \
  --name="Classic T-Shirt" \
  --type=simple \
  --regular_price=29.99 \
  --description="A comfortable cotton t-shirt." \
  --manage_stock=true \
  --stock_quantity=100 \
  --user=admin

wp wc product create \
  --name="Premium Hoodie" \
  --type=simple \
  --regular_price=59.99 \
  --sale_price=49.99 \
  --description="Premium quality hoodie." \
  --manage_stock=true \
  --stock_quantity=50 \
  --user=admin

wp wc product create \
  --name="Baseball Cap" \
  --type=simple \
  --regular_price=19.99 \
  --description="Adjustable baseball cap." \
  --manage_stock=true \
  --stock_quantity=75 \
  --user=admin
```

**Option B: Via WP Admin**

1. **Go to:** Products → Add New
2. **Create 3-5 simple products** with:
   - Name, price, description
   - Stock management enabled
   - Regular price set

---

### 10. Verify Everything Works

**Checklist:**

- [ ] Site loads at the local URL
- [ ] Can log into WP Admin (admin/admin)
- [ ] WooCommerce is active and configured
- [ ] Storefront theme is installed (not active - Interview Theme should be active)
- [ ] Interview Theme is active (Appearance → Themes)
- [ ] Interview Plugin is active (Plugins page)
- [ ] Products exist (if you added them)
- [ ] Shop page displays products

**Test the workspace files:**

1. **Right-click site** → "Reveal in Finder/Explorer"
2. **Navigate to:** `app/public/wp-content/themes/interview-theme/`
3. **Open:** `functions.php` in a text editor
4. **Verify** you see the "CANDIDATE WORKSPACE BELOW" section

---

### 11. Export the Site

1. **Right-click the site** in LocalWP
2. **Choose:** "Export"
3. **Wait** for the export to complete (1-3 minutes)
4. **LocalWP will show** the location of the `.zip` file

**Default export location:**
- **Mac:** `~/Downloads/woocommerce-interview-[timestamp].zip`
- **Windows:** `C:\Users\[YourName]\Downloads\woocommerce-interview-[timestamp].zip`

**File size:** Typically 400-600 MB

---

### 12. Upload to File Sharing Service

**Option A: Dropbox**
1. Upload the `.zip` to Dropbox
2. Right-click → "Copy Dropbox Link"
3. Get shareable link

**Option B: Google Drive**
1. Upload to Google Drive
2. Right-click → "Share" → "Get link"
3. Set to "Anyone with the link can view"

**Option C: WeTransfer**
1. Go to wetransfer.com
2. Upload the `.zip`
3. Get download link (expires after 7 days)

**Option D: Your own server/hosting**
- Upload via FTP/SFTP to your web server
- Provide direct download URL

**Important:** Save this link! You'll need it for the candidate email template.

---

### 13. Test the Import (Critical!)

**Test on a different machine or folder:**

1. **Create a fresh LocalWP install** (or use a different computer)
2. **Click "+"** → "Import site"
3. **Select your exported `.zip`**
4. **Wait for import** to complete
5. **Start the site**
6. **Verify:**
   - Site loads correctly
   - Can log in (admin/admin)
   - Interview Theme is active
   - Interview Plugin is active
   - Workspace files are present

**If anything is wrong, go back and fix it, then export again.**

---

### 14. Update the Candidate Email Template

Now that you have the `.zip` file URL, update the email template:

1. **Open:** `CANDIDATE_EMAIL_TEMPLATE.md`
2. **Replace** `[YOUR_LOCALWP_ZIP_LINK]` with your actual download link
3. **Save the file**

Example:
```markdown
2. Download the pre-configured site: https://www.dropbox.com/s/abc123/woocommerce-interview.zip
```

---

## Troubleshooting

### Can't activate Interview Theme
**Error:** "The parent theme is missing. Please install the 'Storefront' parent theme."

**Fix:** Install and activate Storefront first, then activate Interview Theme.

---

### Interview Plugin won't activate
**Error:** "Interview Plugin requires WooCommerce to be installed and activated."

**Fix:** Install and activate WooCommerce first.

---

### Export file is too large (>1GB)
**Likely cause:** Many WordPress core files or large uploads folder.

**Fix:**
- Delete unnecessary plugins/themes from the site
- Clear the uploads folder if it has large files
- Re-export

---

### Site shell commands fail
**Error:** `wp: command not found`

**Fix:**
- Use LocalWP's built-in shell (Right-click site → "Open site shell")
- Don't use your system terminal

---

## Quick Setup Script (Advanced)

If you're comfortable with the command line, you can automate steps 4-8:

**Save this as `localwp-setup.sh` in your LocalWP site shell:**

```bash
#!/bin/bash

echo "Installing WooCommerce..."
wp plugin install woocommerce --activate

echo "Installing Storefront theme..."
wp theme install storefront --activate

echo "Configuring WooCommerce..."
wp option update woocommerce_task_list_hidden "yes"
wp option update woocommerce_onboarding_opt_in "no"
wp option update woocommerce_store_address "123 Interview St"
wp option update woocommerce_store_city "Test City"
wp option update woocommerce_default_country "US:CA"
wp option update woocommerce_currency "USD"

echo "Setting permalinks..."
wp rewrite structure '/%postname%/' --hard

echo "Activating Interview Theme..."
wp theme activate interview-theme

echo "Activating Interview Plugin..."
wp plugin activate interview-plugin

echo "Done! Ready to export."
```

**Then manually copy the theme/plugin folders and run:**
```bash
bash localwp-setup.sh
```

---

## Maintenance

**When to re-export:**
- When you update interview exercises
- When WooCommerce/WordPress major versions update
- If you find bugs in the setup

**Best practice:**
- Keep the LocalWP site around for quick re-exports
- Test the import after each new export
- Version your `.zip` files (e.g., `woocommerce-interview-v1.zip`)

---

## Summary

You now have:
1. ✅ LocalWP site configured with WooCommerce
2. ✅ Interview Theme and Plugin installed
3. ✅ Exported `.zip` file
4. ✅ Uploaded to file sharing service
5. ✅ Download link ready for candidates

**Next step:** Update `CANDIDATE_EMAIL_TEMPLATE.md` with your download link and send to candidates!

---

**Estimated total time:** 15-20 minutes for first setup, 5 minutes for re-exports.
