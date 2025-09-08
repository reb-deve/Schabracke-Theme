# Schabracke WordPress Theme

![WordPress Version](https://img.shields.io/badge/WordPress-6.x-blue?logo=wordpress) ![PHP Version](https://img.shields.io/badge/PHP-8.x-blue?logo=php) ![License](https://img.shields.io/badge/License-GPLv2%2B-green)

![Schabracke Theme Screenshot](screenshot.png)

---

## 🌟 Description

**Schabracke** is a custom WordPress theme designed for a youth center website.  
It features modern responsive design using TailwindCSS, dynamic pages, and a structured layout for events, team, partners, and more.

**Key Features:**

- Custom post types: **Team**, **Events**
- Custom pages: `page-angebot.php`, `page-partner.php`, `page-team.php`, `page-datenschutzerklaerung.php`
- Responsive grid layout for archives, posts, and sidebars
- Sidebar with **recent posts**, **categories**, and **upcoming events**
- Fully editable pages without plugins (custom fields optional)
- Styled cards and components for a modern, clean look

---

## 🖥️ Screenshots

**Home Page**  
![Home Page](images/homepage.png)

**Team Page**  
![Team Page](images/team-page.png)

**Angebote Page**  
![Angebote Page](images/angebote-page.png)

---

## 🚀 Installation

1. Upload the `Schabracke` theme folder to your WordPress installation under `wp-content/themes/`.
2. Activate the theme via **Appearance → Themes**.
3. Create the required pages (`Angebote`, `Team`, `Partner`, `Datenschutzerklärung`) and assign the correct templates.
4. Flush permalinks: **Settings → Permalinks → Save Changes**.
5. Add posts and categorize them (e.g., “Aktuelles”).

---

## 🛠️ Usage

### Custom Pages
- `page-angebot.php` – dynamic Angebote page
- `page-partner.php` – list of partners
- `page-team.php` – team members listing
- `page-datenschutzerklaerung.php` – privacy page

### Team Members
- Add members using **Team** custom post type.
- Fill meta fields: Position, Email, Phone, Photo.

### Events
- Add events with custom meta: Date, Time, Location.
- Displayed dynamically in sidebar and archives.

### Posts
- Add posts and assign **categories**.
- “Read more” links go to `single.php` for full post view.

---

## ⚡ Recommended Plugins (Optional)

- **Classic Editor** or **Gutenberg** (for editing content)
- **Advanced Custom Fields** (optional, for more complex fields)
- **WP Event Manager** (if you want extended event management)

---

## 📝 License

This theme is released under the **GPL v2+** license.  
You are free to use, modify, and distribute it.

---

## 📦 Folder Structure

Schabracke/
├─ css/
├─ js/
├─ images/
├─ template-parts/
│ └─ content.php
├─ page-angebot.php
├─ page-partner.php
├─ page-team.php
├─ page-datenschutzerklaerung.php
├─ single.php
├─ archive.php
├─ category-aktuelles.php
├─ functions.php
├─ style.css
└─ README.md

---

## 🔗 Links

- [WordPress.org](https://wordpress.org/)
- [TailwindCSS](https://tailwindcss.com/)
- [GitHub Repository](https://github.com/reb-dev/schabracke-theme)
