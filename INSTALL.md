# Installation Guide

This guide walks you through installing the **Legal Clarity Theme** on a WordPress site hosted with cPanel. It is written for non-developers — you do not need to know code to follow along.

If you get stuck, jump to the **Troubleshooting** section at the bottom.

---

## What you will do

1. Install WordPress on your hosting (via cPanel).
2. Upload the theme files.
3. Activate the theme.
4. Verify the pages were created automatically.
5. Set the homepage.
6. Replace the logo.
7. Set a clean URL structure (permalinks).
8. Add your first blog post.
9. Edit page content.

Estimated time: 20 - 30 minutes.

---

## Step 1. Install WordPress in cPanel

Most shared hosts (Bluehost, SiteGround, HostGator, NameHero, A2, etc.) offer a one-click WordPress installer through **Softaculous** or a similarly named tool.

1. Log in to **cPanel** (usually `https://yourdomain.com/cpanel` or through the welcome email from your host).
2. Scroll to the section labeled **Softaculous Apps Installer**, **WordPress Manager**, or **Site Software**.
3. Click the **WordPress** icon.
4. Click **Install** (or **Install Now**).
5. Fill in the fields:
   - **Choose Protocol:** `https://` (recommended — requires SSL, which most hosts provide free via Let's Encrypt).
   - **Choose Domain:** your domain (e.g. `thelegalclarityproject.com`).
   - **In Directory:** leave blank to install at the root (recommended). If you put `blog` here WordPress installs at `yourdomain.com/blog` instead.
   - **Site Name:** `The Legal Clarity Project`
   - **Site Description:** `Plain-language legal explainers`
   - **Admin Username:** pick something other than `admin`.
   - **Admin Password:** use a strong password and save it in a password manager.
   - **Admin Email:** your email address.
6. Click **Install**. Wait ~30 seconds.
7. When it completes you will see two URLs:
   - **Site URL:** `https://yourdomain.com/`
   - **Admin URL:** `https://yourdomain.com/wp-admin/`

Log in to the admin URL with the username and password you just set. You should see the WordPress dashboard.

---

## Step 2. Upload the theme

You have the `legal-clarity-theme` folder on your computer. It needs to end up at:

```
/public_html/wp-content/themes/legal-clarity-theme/
```

Pick **one** of the two methods below. Method A (File Manager) is easier for most people.

### Method A. File Manager + ZIP (recommended)

1. On your computer, compress the `legal-clarity-theme` folder into a ZIP file:
   - **macOS:** right-click the folder -> **Compress "legal-clarity-theme"**. You'll get `legal-clarity-theme.zip`.
   - **Windows:** right-click the folder -> **Send to** -> **Compressed (zipped) folder**.
2. In cPanel, open **File Manager**.
3. Navigate to `public_html/wp-content/themes/`.
4. Click **Upload** at the top.
5. Select the `legal-clarity-theme.zip` file you created and wait for the upload progress bar to finish.
6. Click **Go Back to "/home/USER/public_html/wp-content/themes"** link.
7. Right-click the uploaded `legal-clarity-theme.zip` and choose **Extract**. Confirm the extraction path is `/public_html/wp-content/themes/`.
8. You should now see a folder `legal-clarity-theme` inside the `themes` directory. Delete the `.zip` file to tidy up (optional).

**Verify:** inside `legal-clarity-theme/` you should see `style.css`, `functions.php`, `index.php`, plus folders like `assets/`, `inc/`, `page-templates/`. If you instead see a single folder *inside* `legal-clarity-theme/` with those files in it, you have a double-nested folder — move the inner contents up one level.

### Method B. FTP / SFTP

If you prefer FTP:

1. In cPanel, open **FTP Accounts** and either create a new FTP user or note your existing credentials.
2. Download **FileZilla** (free, cross-platform) from https://filezilla-project.org.
3. In FileZilla, connect:
   - **Host:** `ftp.yourdomain.com` (or the hostname your cPanel shows).
   - **Username:** the FTP username.
   - **Password:** the FTP password.
   - **Port:** `21` for FTP, `22` for SFTP (SFTP preferred if your host supports it).
4. On the right-hand (remote) pane, navigate to `/public_html/wp-content/themes/`.
5. On the left-hand (local) pane, navigate to the folder containing `legal-clarity-theme` on your computer.
6. Drag the entire `legal-clarity-theme` folder from left to right. Wait for the transfer queue to empty (can take 1 - 3 minutes).

---

## Step 3. Activate the theme

1. Log in to WordPress admin: `https://yourdomain.com/wp-admin/`.
2. Go to **Appearance -> Themes**.
3. You should see a tile labeled **The Legal Clarity Project**. Hover over it and click **Activate**.

On activation, the theme automatically:
- Creates the core pages (Home, About, Dictionary, Insights, Contact, Contribute, Privacy, Terms, Accessibility).
- Sets the **Home** page as the static front page.
- Registers the primary and footer navigation menu locations.

---

## Step 4. Confirm pages were auto-created

1. Go to **Pages -> All Pages**.
2. You should see these pages listed: Home, About, Dictionary, Insights, Contact, Contribute, Privacy Policy, Terms, Accessibility.
3. If any are missing, you can deactivate and reactivate the theme to re-trigger creation. Existing pages will not be overwritten.

---

## Step 5. Verify the front page

The theme sets this automatically, but please double-check:

1. Go to **Settings -> Reading**.
2. Under **Your homepage displays**, select **A static page**.
3. **Homepage:** choose **Home**.
4. **Posts page:** choose **Insights**.
5. Click **Save Changes**.

Visit `https://yourdomain.com/` in an incognito/private window to confirm the homepage renders.

---

## Step 6. Replace the logo

The theme ships with a placeholder SVG logo at `assets/images/logo.svg`. To swap it:

**Option 1 - Edit the SVG directly (keeps it crisp at all sizes):**

1. In cPanel File Manager, navigate to `public_html/wp-content/themes/legal-clarity-theme/assets/images/`.
2. Right-click `logo.svg` -> **Edit**. Replace the contents with your own SVG markup.
3. Save.

**Option 2 - Use a PNG instead:**

1. Prepare a PNG of your logo at roughly 512x512 pixels, transparent background. Name it `logo.png`.
2. Upload it to `public_html/wp-content/themes/legal-clarity-theme/assets/images/` (overwriting the placeholder `logo.png.txt` note is fine — you can delete `logo.png.txt`).
3. Edit `functions.php` and change the line:
   ```php
   $img = TLCP_URI . '/assets/images/logo.svg';
   ```
   to:
   ```php
   $img = TLCP_URI . '/assets/images/logo.png';
   ```
4. Save.

The same approach applies to `favicon.svg` (replace with `favicon.png` and update `tlcp_favicon()` in `functions.php`).

---

## Step 7. Set permalinks to "Post name"

This gives clean URLs like `/insights/my-post-title/` instead of `/?p=123`.

1. Go to **Settings -> Permalinks**.
2. Under **Common Settings**, select **Post name**.
3. Click **Save Changes**.

You must do this step or some links will 404.

---

## Step 8. Add an Insights blog post

1. Go to **Posts -> Add New**.
2. Enter a title, for example *"Understanding Force Majeure in Plain English"*.
3. Write the body in the editor.
4. (Optional) On the right sidebar, set a **Featured image** and add **Categories** / **Tags**.
5. Click **Publish** (top right).
6. View the post at `https://yourdomain.com/insights/your-slug/`.

Posts appear automatically on the **Insights** page and on the homepage's recent-posts section.

---

## Step 9. Edit page content

1. Go to **Pages -> All Pages**.
2. Hover the page you want to change (e.g. **About**) and click **Edit**.
3. Update the content in the block editor.
4. Click **Update**.

The page templates are designed so you can safely edit the text without breaking the layout.

---

## Troubleshooting

### White screen / "critical error" after activating
Almost always a PHP version issue.

1. In cPanel, open **Select PHP Version** (or **MultiPHP Manager**).
2. Ensure the version is **7.4 or higher** (8.1 or 8.2 recommended).
3. Save and revisit the site.

If the issue persists, enable WordPress debug mode by adding this to `wp-config.php` (above the `/* That's all, stop editing! */` line):
```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```
Then check `wp-content/debug.log` for the exact error.

### Pages return 404 "Not Found"
Your permalink rewrite rules need to be regenerated.

1. Go to **Settings -> Permalinks**.
2. Without changing anything, click **Save Changes**.
3. Reload the broken page.

### Theme uploaded but not showing in Appearance -> Themes
- Check that `style.css` sits directly at `/wp-content/themes/legal-clarity-theme/style.css` (not nested one level deeper).
- Check file permissions: folders should be `755`, files `644`. cPanel File Manager -> right-click -> **Change Permissions** to fix.

### Logo is broken / missing
- Confirm the file exists at `wp-content/themes/legal-clarity-theme/assets/images/logo.svg`.
- In your browser, load `https://yourdomain.com/wp-content/themes/legal-clarity-theme/assets/images/logo.svg` directly — if you see the image, the file is fine and the issue is elsewhere. If you see a 404, the file did not upload correctly.

### Contact form not sending email
Shared hosts sometimes block the PHP `mail()` function. Install the free **WP Mail SMTP** plugin (**Plugins -> Add New -> search "WP Mail SMTP"**) and configure it with your email provider (Gmail, Mailgun, SendGrid, etc.).

### Menus are empty
The theme registers two menu locations (Primary, Footer) but does not auto-populate them.

1. Go to **Appearance -> Menus**.
2. Click **create a new menu**, name it "Main".
3. Check the pages you want to add and click **Add to Menu**.
4. Under **Menu Settings -> Display location**, check **Primary Navigation**.
5. Click **Save Menu**. Repeat for the footer menu if desired.

---

## Quick reference paths

| What | Where |
|------|-------|
| Theme folder | `/public_html/wp-content/themes/legal-clarity-theme/` |
| Logo file | `/public_html/wp-content/themes/legal-clarity-theme/assets/images/logo.svg` |
| Favicon file | `/public_html/wp-content/themes/legal-clarity-theme/assets/images/favicon.svg` |
| Theme preview screenshot | `/public_html/wp-content/themes/legal-clarity-theme/screenshot.png` |
| WordPress admin | `https://yourdomain.com/wp-admin/` |

---

You're done. If you make a change and don't see it, try a hard refresh: **Cmd+Shift+R** (Mac) or **Ctrl+F5** (Windows).
