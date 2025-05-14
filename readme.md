# YakStretch Cover Block

A custom ACF-powered WordPress block that rotates background images with configurable overlays and flexible content placement. Built for performance, accessibility, and a smooth editorial experience.

---

## Features

- ✅ Rotating background images (fade-in/fade-out)
- 🎲 Optional randomization
- 🎨 Overlay styles: flat or directional gradient
- 🧭 9-position content placement (e.g. top-left, center-center, bottom-right)
- 📐 Min-height control (desktop and mobile)
- 🧱 Full `InnerBlocks` support (add any block content)
- 🖼 Editor preview with real-time ACF field sync
- 🧩 Native block alignment support (`full`, `wide`, etc.)

---

## Requirements

- WordPress 6.0+
- PHP 7.4+
- [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/) (for block registration and fields)

---

## Installation

1. Clone or download this repo into your WordPress `/wp-content/plugins/` directory.
2. Activate the plugin via the WordPress admin.
3. Ensure ACF Pro is installed and active.
4. Edit any post or page using the Block Editor.
5. Insert the **YakStretch Cover** block and configure the block settings in the sidebar.

---

## Field Settings

The block exposes the following ACF fields in the sidebar:

- **Gallery** (Image array)
- **Randomize** (true/false)
- **Content Placement** (`top left`, `center center`, `bottom right`, etc.)
- **Delay** (ms between image switches)
- **Fade Duration** (ms for crossfade)
- **Overlay Style** (`flat`, `gradient`)
- **Overlay Color** (supports alpha)
- **Min Height (Desktop)** (e.g. `500px` or `100vh`)
- **Min Height (Mobile)** (e.g. `300px`)

---

## Developer Notes

- CSS follows a layered architecture for theme integration (`@layer components` etc.)
- JavaScript uses fade logic and image preloading to ensure smooth transitions
- The first image loads instantly (no fade) for performance and accessibility
- Editor-side logic handles background rendering via MutationObserver to support live ACF field updates

---

## Roadmap

- [ ] Add rotation preview toggle in editor
- [ ] Add autoplay pause on hover
- [ ] Add per-image link or caption support
- [ ] Add optional background-blur layer

---

## License

[GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)

---

## Credits

Built with ❤️ by [Tomatillo Design](https://tomatillodesign.com) for the [Yak Theme](https://github.com/tomatillodesign/yak).
