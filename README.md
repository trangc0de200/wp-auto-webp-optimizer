# WP Auto WebP Optimizer

A lightweight, plug-and-play WordPress plugin designed to automatically convert newly uploaded images (JPG, JPEG, PNG) to the next-gen **WebP** format. It applies an optimal 80% compression quality and safely removes the original files to keep your hosting storage clean and efficient.

## ✨ Features

- **Automatic Conversion:** Seamlessly converts `.jpg`, `.jpeg`, and `.png` files to `.webp` during the WordPress upload process.
- **Optimized Quality:** Forces an 80% compression quality for the main WebP image and all generated sub-sizes (thumbnails, medium, large, etc.), ensuring fast page load times without noticeable visual loss.
- **Storage Saver:** Automatically unlinks (deletes) the original JPG/PNG files after successful conversion to prevent server bloat.
- **Clean Code:** Written in PHP with Object-Oriented Programming (OOP) principles to avoid conflicts with other plugins.
- **Zero Configuration:** No settings panel needed. Just activate and it works.

## ⚠️ IMPORTANT WARNING: For NEW Uploads Only!

**Please read this carefully before using the plugin:**

- This plugin is strictly designed to process **NEW image uploads** moving forward. 
- **DO NOT** use this plugin in combination with tools like "Regenerate Thumbnails" to process your existing media library. 
- **Why?** Because this plugin deletes the original `.jpg` or `.png` file upon conversion. If you force it on old images, the old image URLs embedded in your existing posts/pages will still point to the `.jpg` extension, resulting in broken images (404 errors) across your site.
- To optimize **old images**, it is highly recommended to use standard caching/optimization plugins (like *Converter for Media* or *LiteSpeed Cache*) that create parallel WebP files and serve them via `.htaccess` rewrite rules without deleting the original files.

## 🚀 Installation

1. Download the plugin folder or the `.zip` file from this repository.
2. Go to your WordPress Admin Dashboard.
3. Navigate to **Plugins > Add New > Upload Plugin**.
4. Upload the `.zip` file and click **Install Now**.
5. Click **Activate Plugin**.
6. Alternatively, you can upload the unzipped folder directly to your `/wp-content/plugins/` directory via FTP/SFTP and activate it through the WordPress dashboard.

## 🛠️ Server Requirements

- **WordPress:** 5.8 or higher (WordPress core natively supports WebP from 5.8 onwards).
- **PHP:** 7.4 or higher.
- **Image Editor:** Your web server must have either the **GD** or **Imagick** PHP extension installed and compiled with WebP support (most modern hosting providers have this enabled by default).

## 📄 License

This project is licensed under the GPL-2.0+ License. Feel free to modify and distribute it.
