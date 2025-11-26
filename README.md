# WooCommerce Category Accordion Widget

A modern WordPress widget displaying WooCommerce product categories in an interactive accordion form with elegant styling.

## Description

This plugin adds a widget to WordPress that displays WooCommerce product categories in an expandable list (accordion). The widget features:
- Elegant, minimalist design with purple color scheme
- Smooth expand/collapse animations
- Full accessibility support (ARIA, keyboard)
- State persistence for expanded categories (localStorage)
- Fully responsive
- Configurable display options
- Customizable colors and font sizes

## Requirements

- WordPress 5.0 or newer
- PHP 7.0 or newer
- WooCommerce 3.0 or newer

## Installation

1. Download the `wc-category-accordion-widget` folder
2. Move it to the `/wp-content/plugins/` directory
3. Go to WordPress admin panel → Plugins
4. Find "WooCommerce Category Accordion Widget" and click "Activate"

## Usage

### Adding the widget

1. Go to **Appearance → Widgets** (or **Appearance → Customize → Widgets**)
2. Find the **"Product Categories (Accordion)"** widget
3. Drag it to your desired widget area
4. Configure options as needed
5. Click **Save**

### Configuration options

The widget offers the following options:

**Basic Settings:**
- **Title** - Widget heading (default: "Product Categories")
- **Sort by** - Name / Product count / ID / Slug
- **Order** - Ascending / Descending
- **Show product count** - Displays the number of products in each category
- **Hide empty categories** - Hides categories without products
- **Show subcategories** - Enables hierarchical category display

**Typography:**
- **Title font size** - Size in pixels (10-48px, default: 18px)
- **Category font size** - Size in pixels (10-32px, default: 14px)

**Color Scheme:**
- **Category text color** - Default: #2d3748
- **Text color on hover** - Default: #7c3aed
- **Container background color** - Default: #ffffff
- **Background color on hover** - Default: #f7fafc
- **Border color** - Default: #e8e8e8
- **Counter background color** - Default: #e2e8f0
- **Counter text color** - Default: #4a5568
- **Accordion icon color** - Default: #718096
- **Icon color (expanded)** - Default: #7c3aed

## Translations

The plugin is translation-ready and includes:
- **English** (en_US) - built-in
- **Polish** (pl_PL) - built-in

### Adding new translations

You can add translations using popular WordPress translation plugins:

#### Method 1: Using Loco Translate (Recommended)

1. Install and activate [Loco Translate](https://wordpress.org/plugins/loco-translate/)
2. Go to **Loco Translate → Plugins**
3. Select **WooCommerce Category Accordion Widget**
4. Click **New language**
5. Select your language and click **Start translating**
6. Translate all strings and save

#### Method 2: Using WPML

1. Install and activate [WPML](https://wpml.org/)
2. Go to **WPML → Theme and plugins localization**
3. Find **WooCommerce Category Accordion Widget**
4. Click **Scan for strings**
5. Translate strings in your language

#### Method 3: Manual translation with Poedit

1. Download and install [Poedit](https://poedit.net/)
2. Open `/wp-content/plugins/wc-category-accordion-widget/languages/wc-category-accordion-widget.pot`
3. Choose **Create new translation**
4. Select your language
5. Translate all strings
6. Save as `wc-category-accordion-widget-{locale}.po` (e.g., `wc-category-accordion-widget-de_DE.po`)
7. Poedit will automatically generate the `.mo` file
8. Upload both files to the `languages` folder

## Customization

### Changing colors via widget settings

All colors can be customized directly from the widget settings in WordPress admin panel. No need to edit CSS files.

### Single expand mode

To enable a mode where only one category can be expanded at a time, edit `assets/js/script.js` and uncomment the marked code fragment (around line 35):

```javascript
// Uncomment this code:
mainCategories.forEach(function(otherCategory) {
    if (otherCategory !== category && otherCategory.classList.contains('expanded')) {
        otherCategory.classList.remove('expanded');
    }
});
```

### Additional styles

You can add custom styles in your theme's CSS file:

```css
/* Change title font size */
.widget.wc-category-accordion-widget .widget-title {
    font-size: 14px;
}

/* Change container padding */
.wc-category-accordion-widget__container {
    padding: 24px;
}
```

## Shortcode (optional)

If you want to use the widget as a shortcode, add to your theme's `functions.php`:

```php
function wc_category_accordion_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Product Categories',
        'show_counts' => true,
        'hide_empty' => true,
    ), $atts);
    
    ob_start();
    the_widget('WC_Category_Accordion_Widget', $atts);
    return ob_get_clean();
}
add_shortcode('wc_categories', 'wc_category_accordion_shortcode');
```

Usage:
```
[wc_categories title="Our Categories" show_counts="1"]
```

## Features

### Accessibility

- Full screen reader support (ARIA labels)
- Keyboard navigation:
  - **Space/Enter** - rozwiń/zwiń kategorię
  - **Space/Enter** - Expand/collapse category
  - **Escape** - Collapse all categories
- Focus states for interactive elements

### Responsiveness

The widget automatically adapts to mobile devices:
- Reduced fonts on small screens
- Reduced spacing
- Full functionality preserved

### State persistence

The state of expanded categories is saved in the browser's localStorage, so it persists between page refreshes.

## Troubleshooting

### Widget doesn't display categories

1. Make sure WooCommerce is active
2. Check if you have created product categories in WooCommerce
3. If "Hide empty categories" is enabled, make sure categories contain products

### Styles don't work

1. Clear browser cache and caching plugin cache
2. Check if CSS files are loaded correctly (DevTools → Network)
3. Increase CSS selector specificity by adding `!important` if theme overrides styles

### Accordion doesn't expand

1. Check browser console (F12) for JavaScript errors
2. Make sure `assets/js/script.js` is loaded correctly
3. Check if categories have subcategories ("Show subcategories" option must be enabled)

## Support

For issues or questions:
- Check WooCommerce documentation
- Review the source code in the plugin directory
- Contact the author via [GitHub Issues](https://github.com/jklebucki/WPCategoryAccordion/issues)

## License

GPL v2 or later - https://www.gnu.org/licenses/gpl-2.0.html

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed version history.

## Author

**Jarosław Kłębucki**
- GitHub: [@jklebucki](https://github.com/jklebucki)
- Plugin URI: https://github.com/jklebucki/WPCategoryAccordion
