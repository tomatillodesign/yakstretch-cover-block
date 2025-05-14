=== Yak Card Deck ===
Contributors: tomatillodesign  
Tags: custom block, ACF block, info cards, grid layout, Gutenberg  
Requires at least: 6.0  
Tested up to: 6.5  
Requires PHP: 7.4  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

A custom Gutenberg block that displays flexible, ACF-powered info cards in a grid/deck layout. Designed for WordPress themes built with Yak or Tomatillo Design tools.

== Description ==

**Yak Card Deck** provides a custom "Info Cards" block built with Advanced Custom Fields (ACF PRO) to display visually consistent content cards. Ideal for showcasing team members, locations, features, or service offerings in a responsive deck-style grid.

The block is registered via ACF's `acf_register_block_type()` API, and comes with pre-styled templates and a working `block.json` configuration. Styles are included and scoped for the block. ACF fields are bundled directly within the plugin.

== Features ==

- Responsive card layout using full-width `align: full`
- Custom card styling via CSS
- Flexible ACF-based card content
- Supports:
  - Display-only cards
  - Linked cards
  - Modal pop-ups
  - Expandable/collapsible cards
- Works with images, icons, titles, descriptions, and custom fields

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/yak-card-deck/` or clone it via Git:
   `git clone https://github.com/tomatillodesign/yak-card-deck.git`
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Ensure **ACF PRO** is installed and activated.
4. Add the **Info Cards** block in the Gutenberg editor.

== Usage ==

1. Insert the "Info Cards" block in any post, page, or custom block area.
2. Use the sidebar panel to configure card contents using the built-in ACF fields.
3. Customize styles as needed in the block CSS file:  
   `/blocks/clb-custom-info-card/clb_custom_info_card.css`

== Frequently Asked Questions ==

= Do I need ACF PRO? =  
Yes. This plugin uses ACF block registration which is only available in ACF PRO.

= Can I customize the card layout? =  
Yes. The block’s layout is defined in the `clb_custom_info_card.php` template and styled in the accompanying CSS file.

== Changelog ==

= 1.0.0 =
* Initial release of Yak Card Deck block
* Includes one custom ACF block with full alignment support

== Upgrade Notice ==

= 1.0.0 =
First stable version. Make sure ACF PRO is installed and activated.

== Credits ==

Developed by [Tomatillo Design](https://github.com/tomatillodesign)

== License ==

This plugin is licensed under the GPLv2 or later.
