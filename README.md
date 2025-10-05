# WooCommerce Developer Interview Environment

Welcome! This is a pre-configured WordPress + WooCommerce development environment for your technical interview.

## Choose Your Setup Method

Pick whichever method you're most comfortable with:
- **[Option 1: LocalWP](#option-1-localwp-recommended)** - Easiest (2 minutes)
- **[Option 2: Docker](#option-2-docker)** - If you prefer containers
- **[Option 3: Your Own Setup](#option-3-bring-your-own-environment)** - Use your preferred local dev tool

---

## Option 1: LocalWP (Recommended)

**Perfect for:** Most WordPress developers

### Steps:

1. **Install LocalWP** (if you don't have it)
   - Download: [https://localwp.com/](https://localwp.com/)
   - Free and works on Mac/Windows/Linux

2. **Download the site package**
   - Your interviewer will provide a `.zip` file
   - This contains everything pre-configured

3. **Import into LocalWP**
   - Open LocalWP
   - Click the **"+"** button
   - Select **"Import site"**
   - Choose the downloaded `.zip` file
   - Wait 1-2 minutes for import

4. **Start the site**
   - Click **"Start site"** in LocalWP
   - Click **"WP Admin"** to access dashboard

5. **Ready!**
   - Open your preferred code editor
   - Navigate to the site folder (Right-click site → "Reveal in Finder/Explorer")
   - Find the files you'll be editing (see [Workspace Files](#workspace-files) below)

### LocalWP Credentials
- **Admin URL:** Click "WP Admin" in LocalWP
- **Username:** `admin`
- **Password:** `admin`

---

## Option 2: Docker

**Perfect for:** Developers comfortable with Docker/containers

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop) installed
- Git installed

### Steps:

1. **Clone this repository:**
   ```bash
   git clone <YOUR-REPO-URL>
   cd woocommerce-interview
   ```

2. **Run the setup script:**
   ```bash
   ./setup.sh
   ```

   This will:
   - Start Docker containers
   - Install WordPress & WooCommerce
   - Configure the site
   - Activate the interview theme & plugin

   **Wait 2-3 minutes** for everything to complete.

3. **Access the site:**
   - **Frontend:** [http://localhost:8080](http://localhost:8080)
   - **Admin:** [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin)
   - **Username:** `admin`
   - **Password:** `admin`

4. **Optional - Add sample products:**
   ```bash
   ./sample-data.sh
   ```

### Useful Docker Commands

```bash
# Stop containers
docker-compose down

# Restart containers
docker-compose restart

# View logs
docker-compose logs -f wordpress

# Run WP-CLI commands
docker-compose run --rm wpcli wp <command>

# Complete reset (deletes all data)
docker-compose down -v
./setup.sh
```

---

## Option 3: Bring Your Own Environment

**Perfect for:** Developers with existing local dev setups (MAMP, Valet, etc.)

### Steps:

1. **Install fresh WordPress 6.x**
   - Use your preferred local development tool

2. **Install WooCommerce**
   - Via WordPress admin or WP-CLI

3. **Clone wp-content from this repo:**
   ```bash
   cd /path/to/your/wordpress/
   rm -rf wp-content
   git clone <YOUR-REPO-URL> wp-content-temp
   mv wp-content-temp/wp-content ./
   rm -rf wp-content-temp
   ```

4. **Activate the interview theme and plugin:**
   - Go to Appearance → Themes → Activate "Interview Theme"
   - Go to Plugins → Activate "Interview Plugin"

---

## Workspace Files

During the interview, you'll primarily work in these files:

```
wp-content/
├── themes/interview-theme/
│   ├── functions.php    ← Your main workspace for theme functions
│   └── style.css        ← Custom styles if needed
│
└── plugins/interview-plugin/
    └── interview-plugin.php  ← Your main workspace for plugin functions
```

**Make sure you can:**
- ✅ Access the site in your browser
- ✅ Log into wp-admin
- ✅ Open and edit `functions.php` in your IDE
- ✅ See changes when you refresh the browser

---

## Verification Checklist

Before the interview, please verify:

- [ ] WordPress site loads in browser
- [ ] WooCommerce is active (check wp-admin → Plugins)
- [ ] "Interview Theme" is active (check wp-admin → Appearance → Themes)
- [ ] "Interview Plugin" is active (check wp-admin → Plugins)
- [ ] You can edit files in your preferred IDE/editor
- [ ] You know where the log files are (see below)

---

## Debugging & Logs

### Where to find error logs:

**Docker:**
```bash
# WordPress debug log
docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log

# PHP error log
docker-compose logs -f wordpress
```

**LocalWP:**
- Right-click site → "Open site shell"
- Navigate to `wp-content/debug.log`
- Or check: Utilities → Logs → PHP Error Log

**Browser console:**
- Press `F12` or `Cmd+Option+I` (Mac) / `Ctrl+Shift+I` (Windows)

### Debug mode is enabled:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

---

## Technologies Included

- WordPress: Latest
- WooCommerce: Latest
- Theme: Storefront (parent) + Interview Theme (child)
- PHP: 8.1+
- MySQL: 8.0
- WP-CLI available (Docker only)

---

## Troubleshooting

### Docker Issues

**Site not loading?**
```bash
# Check if containers are running
docker-compose ps

# Restart containers
docker-compose restart

# Check logs for errors
docker-compose logs wordpress
```

**Permission errors?**
```bash
docker-compose exec wordpress chown -R www-data:www-data /var/www/html/wp-content
```

**Port 8080 already in use?**
Edit `docker-compose.yml` and change `"8080:80"` to `"8888:80"` (or another port)

### LocalWP Issues

**Site won't start?**
- Check if another local server is running (MAMP, XAMPP)
- Try a different port in LocalWP settings

**Can't find site files?**
- Right-click site → "Reveal in Finder" (Mac) or "Reveal in Explorer" (Windows)

---

## Interview Day

**What you'll need:**
- This environment running and accessible
- Your preferred IDE open (VS Code, PhPStorm, Sublime, etc.)
- Browser with the site loaded
- Screen sharing capability (Zoom, Meet, etc.)

**What's allowed:**
- Using AI tools (Claude Code, Copilot, ChatGPT, etc.)
- Checking WooCommerce documentation
- Searching Google/Stack Overflow
- Using your normal development workflow

**What we're evaluating:**
- Your problem-solving approach
- Deep understanding of WooCommerce
- Code quality and best practices
- Debugging skills
- How you use tools (including AI) effectively

---

## Questions?

If you have any issues with setup, please contact your interviewer **before** the interview day.

**Common setup time:**
- LocalWP: 5 minutes
- Docker: 10 minutes
- Custom setup: 15 minutes

Good luck! 🚀
