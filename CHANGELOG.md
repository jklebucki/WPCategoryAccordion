# WooCommerce Category Accordion Widget

## Changelog

### Version 1.0.3 (2025-11-26)

**New Features**
- Added customizable color scheme with 9 color pickers:
  - Category text color
  - Text color on hover
  - Container background color
  - Background color on hover
  - Border color
  - Counter background color
  - Counter text color
  - Accordion icon color
  - Icon color (expanded state)
- Added font size customization:
  - Title font size (10-48px)
  - Category font size (10-32px)
- Full translation support with .pot template file
- Built-in English (en_US) translation
- Built-in Polish (pl_PL) translation

**Improvements**
- Updated WooCommerce compatibility headers
- Added HPOS (High-Performance Order Storage) compatibility declaration
- Improved inline CSS generation for widget-specific styling
- Enhanced widget form with organized sections

**Documentation**
- README.md translated to English
- Added translation guide for Loco Translate, WPML, and Poedit
- CHANGELOG.md translated to English
- Added detailed configuration options documentation

### Version 1.0.2 (2025-11-26)

**Improvements**
- Updated plugin version
- Fixed WooCommerce compatibility declarations
- Added proper plugin dependency headers

### Version 1.0.1 (2025-11-25)

**Improvements**
- Minor bug fixes
- Code optimization

### Version 1.0.0 (2025-11-25)

**Initial Release**

#### New Features
- Widget displaying WooCommerce categories in accordion form
- Full WooCommerce integration (taxonomy: product_cat)
- Configuration panel in WordPress widgets with options:
  - Widget title
  - Sorting (name, count, ID, slug)
  - Order (ascending/descending)
  - Product count display
  - Hide empty categories
  - Hierarchical subcategory display

#### Design & UX
- Minimalist design with purple color scheme (#7c3aed)
- Smooth CSS animations (transitions, keyframes)
- Responsive layout with mobile breakpoints
- Expanding icons (› rotating 90°)
- Hover states for all interactive elements
- Focus states for accessibility

#### JavaScript
- Vanilla JavaScript (no jQuery dependency)
- Event delegation for performance
- localStorage - persist expanded category states
- Keyboard navigation (Space, Enter, Escape)
- ARIA attributes (aria-expanded, role="button")
- Screen reader support
- Custom event for AJAX re-initialization

#### Technical
- WordPress Coding Standards compliant
- Data sanitization and validation
- Internationalization ready (text domain: wc-category-accordion-widget)
- WooCommerce active check
- Conditional asset loading (only when widget is active)
- GPL v2 license

#### Files
- `wc-category-accordion-widget.php` - Main plugin file
- `assets/css/style.css` - Stylesheets
- `assets/js/script.js` - JavaScript scripts
- `README.md` - Full documentation
- `readme.txt` - WordPress repository format
- `LICENSE` - GPL v2 license

#### Requirements
- WordPress 5.0+
- PHP 7.0+
- WooCommerce 3.0+

#### Known Limitations
- Support for only 2 hierarchy levels (main categories + subcategories)
- No category image support
- No built-in shortcode (requires adding to functions.php)

---

## Planned Features (Future Releases)

### Version 1.1.0
- [ ] Support for deeper hierarchy (3+ levels)
- [ ] Category images (thumbnails)
- [ ] Built-in shortcode support
- [ ] Additional color schemes
- [ ] Grid/list view modes
- [ ] Configurable animations

### Version 1.2.0
- [ ] Gutenberg block integration
- [ ] Elementor widget
- [ ] WPBakery support
- [ ] AJAX filtering
- [ ] Live search functionality

### Version 2.0.0
- [ ] Multi-level deep recursion
- [ ] Custom taxonomy support (not just product_cat)
- [ ] Advanced styling options in admin
- [ ] Import/export settings
- [ ] Analytics tracking
