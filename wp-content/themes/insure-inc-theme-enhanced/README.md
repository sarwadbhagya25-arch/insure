# Insure Inc — Custom WordPress Theme

A fully custom WordPress theme for an automobile insurance landing page, built with **PHP + ACF** (no page builders).

---

## Tech Stack

- Custom WordPress Theme (PHP)
- ACF (Advanced Custom Fields) — for all editable content
- Vanilla JS (no jQuery dependency)
- CSS custom properties, CSS animations
- AJAX form submissions (wp_ajax)

---

## Setup Instructions

### 1. Install WordPress locally
Use [LocalWP](https://localwp.com/) — create a new site, done.

### 2. Add the theme
Copy the `insure-inc-theme` folder to:
```
your-local-site/app/public/wp-content/themes/insure-inc-theme
```

### 3. Activate the theme
WP Admin → Appearance → Themes → **Insure Inc** → Activate

### 4. Install ACF
WP Admin → Plugins → Add New → search **Advanced Custom Fields** → Install & Activate
(Free version works fine)

### 5. Create the Home Page
- WP Admin → Pages → Add New
- Title: `Home`
- On the right sidebar under **Page Attributes**, set **Template** to `Home Page`
- Publish

### 6. Set as Front Page
WP Admin → Settings → Reading → set **Your homepage displays** to **A static page** → select `Home`

### 7. Populate ACF Fields
Open the Home page in the WP editor. You'll see these ACF field groups:
- **Hero Section** — badge text, title, subtitle, phone
- **About Section** — tag, title, content (WYSIWYG), car image, feature badges (repeater)
- **Coverage Section** — title, coverage cards (repeater: icon, title, description)
- **FAQ Section** — title, FAQ items (repeater: question, answer)
- **Contact Section** — title, subtitle, Google Maps embed URL

> All fields have sensible defaults. The site works without filling anything in.

### 8. Car Image (About Section)
Upload any car PNG/JPG via the ACF image field in the About section, or drop a file at:
```
assets/images/car-placeholder.jpg
```

### 9. Google Maps Embed
- Go to [maps.google.com](https://maps.google.com)
- Search your location → Share → Embed a map → copy the `src="..."` URL only
- Paste into the **Google Maps Embed URL** ACF field

---

## File Structure

```
insure-inc-theme/
├── style.css            ← Theme header (required by WordPress)
├── functions.php        ← Theme setup, ACF registration, AJAX handlers
├── header.php           ← Site header + navbar
├── footer.php           ← Site footer
├── index.php            ← Fallback template
├── page-home.php        ← Main homepage template (Page Template: Home Page)
├── acf-json/            ← ACF field group JSON (auto-synced)
└── assets/
    ├── css/
    │   └── main.css     ← All styles
    ├── js/
    │   └── main.js      ← Navbar, FAQ accordion, animations, AJAX forms
    └── images/
        └── car-placeholder.jpg  ← Add your car image here
```

---

## Screen Recording Checklist (for submission)

1. Open WP Admin → Pages → Home (show ACF fields populated)
2. Go through each field group: Hero, About, Coverage, FAQ, Contact
3. Save and view the frontend
4. Demo: FAQ accordion, form submission, scroll animations
5. Show mobile responsiveness (browser dev tools)

---

## Notes

- Forms use `wp_ajax` with nonce verification (secure)
- All content is editable from ACF — nothing hardcoded
- Responsive: mobile hamburger menu, stacked grid on small screens
- Scroll-triggered animations via IntersectionObserver
