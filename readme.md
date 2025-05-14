# Yak Card Deck

A custom Gutenberg block that displays flexible, ACF-powered info cards in a grid/deck layout. Designed for WordPress themes built with Yak or Tomatillo Design tools.

![Plugin Screenshot](https://github.com/tomatillodesign/yak-card-deck/assets/screenshot-1.png) <!-- Replace with actual screenshot URL if needed -->

---

## 🧹 Features

* Responsive card layout with `align: full` support
* Custom card styling via CSS
* Built with ACF PRO’s block API
* Supports:

  * Display-only cards
  * Linked cards
  * Modal pop-ups
  * Expandable/collapsible cards
* Uses images, icons, titles, descriptions, and other ACF fields

---

## 🚀 Installation

1. Clone or download this repo into your WordPress plugins directory:

   ```bash
   git clone https://github.com/tomatillodesign/yak-card-deck.git wp-content/plugins/yak-card-deck
   ```

2. Activate the plugin in your WordPress admin panel under **Plugins**.

3. Make sure **ACF PRO** is installed and active.

4. Add the **Info Cards** block in the Gutenberg editor.

---

## 🧠 Usage

* Insert the “Info Cards” block in any post, page, or custom block area.
* Edit card content using the provided ACF fields.
* Customize the layout in:

  * `blocks/clb-custom-info-card/clb_custom_info_card.php`
* Customize styles in:

  * `blocks/clb-custom-info-card/clb_custom_info_card.css`

---

## 📆 Requirements

* WordPress 6.0+
* PHP 7.4+
* [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/)

---

## 💪 Development

This block is registered using `acf_register_block_type()` with full `block.json` support. ACF fields are included directly in the plugin and do not require manual import.

---

## 📄 License

GPLv2 or later
See [`license.txt`](license.txt)

---

## ✍️ Author

[Tomatillo Design](https://github.com/tomatillodesign)
