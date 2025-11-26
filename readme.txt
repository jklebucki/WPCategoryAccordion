=== WooCommerce Category Accordion Widget ===
Contributors: jklebucki
Tags: woocommerce, categories, accordion, widget, sidebar, product categories
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.0
Stable tag: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Modern widget displaying WooCommerce product categories in an interactive accordion form.

== Description ==

WooCommerce Category Accordion Widget is an elegant plugin that adds a widget for displaying WooCommerce product categories in an expandable list (accordion) format.

**Key Features:**

* Interactive accordion with smooth animations
* Elegant, minimalist design
* Full configuration via widget panel
* Sort categories by name, product count, ID, or slug
* Optional product count display
* Hierarchical subcategory display
* Persistent state for expanded categories
* Full accessibility support (ARIA, keyboard navigation)
* Responsive design
* Easy color customization with 9 color pickers
* Customizable font sizes for title and categories
* Translation ready with English and Polish included

**Customization Options:**

* Title and category font sizes
* Category text color
* Text color on hover
* Container background color
* Background color on hover
* Border color
* Counter background and text colors
* Accordion icon colors (normal and expanded states)

**Requirements:**

* WooCommerce 3.0 or newer

**Languages:**

* English (en_US)
* Polish (pl_PL)
* Translation ready for other languages via Loco Translate, WPML, or Poedit

== Installation ==

1. Upload the `wc-category-accordion-widget` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Appearance → Widgets
4. Add the "Product Categories (Accordion)" widget to your desired widget area
5. Configure options as needed

== Frequently Asked Questions ==

= Does the plugin require WooCommerce? =

Yes, the plugin requires WooCommerce 3.0 or newer to be installed and active.

= Can I change the colors? =

Yes! The plugin includes 9 color pickers in the widget settings panel. You can customize all colors directly from the WordPress admin without editing any files.

= How do I add translations? =

The plugin is translation-ready. You can add translations using:
1. Loco Translate plugin (recommended)
2. WPML
3. Poedit - manually editing .po files in the languages folder

See the languages/README.md file for detailed instructions.

= Can I customize font sizes? =

Yes, you can set custom font sizes for both the widget title (10-48px) and category names (10-32px) directly in the widget settings.

= Can I use the widget as a shortcode? =

The plugin doesn't include a built-in shortcode, but you can easily add one to your theme's functions.php file. See the README.md file for the code example.

= How does keyboard navigation work? =

* **Space/Enter** - Expand/collapse category
* **Escape** - Collapse all categories
* **Tab** - Navigate between categories

= Does it support AJAX? =

Yes, the widget includes custom events for AJAX re-initialization. After AJAX content loads, dispatch a 'wc-category-accordion-init' event.

== Screenshots ==

1. Widget configuration panel with all options
2. Accordion widget in sidebar - collapsed state
3. Accordion widget with expanded categories
4. Color customization options
5. Mobile responsive view

== Changelog ==

= 1.0.3 (2025-11-26) =
* Added: Customizable color scheme with 9 color pickers
* Added: Font size customization for title and categories
* Added: Full translation support with .pot template
* Added: Built-in English and Polish translations
* Improved: WooCommerce compatibility headers
* Improved: HPOS compatibility declaration
* Updated: README and documentation to English

= 1.0.2 (2025-11-26) =
* Fixed: WooCommerce compatibility declarations
* Updated: Plugin version and headers

= 1.0.1 (2025-11-25) =
* Minor bug fixes and optimizations

= 1.0.0 (2025-11-25) =
* Initial release
* Interactive accordion widget
* Full configuration panel
* Accessibility support
* Responsive design
* localStorage state persistence

== Upgrade Notice ==

= 1.0.3 =
Major update with color customization, font size options, and full translation support. All existing widgets will continue to work with default colors.

= 1.0.0 =
Initial release.

== Additional Info ==

**Support:** For issues or questions, please visit [GitHub Issues](https://github.com/jklebucki/WPCategoryAccordion/issues)

**Contributing:** Contributions are welcome on [GitHub](https://github.com/jklebucki/WPCategoryAccordion)

**Translations:** If you create a translation, please consider sharing it via pull request!

Tak, możesz dodać funkcję shortcode w pliku `functions.php` motywu. Instrukcje znajdują się w pliku README.md.

= Czy widget jest responsywny? =

Tak, widget automatycznie dostosowuje się do różnych rozmiarów ekranów.

= Czy obsługuje accessibility? =

Tak, widget posiada pełną obsługę czytników ekranu (ARIA) oraz nawigację klawiaturą.

== Screenshots ==

1. Widget w akcji - rozwinięta kategoria z podkategoriami
2. Panel konfiguracji widgetu w administracji
3. Widok na urządzeniach mobilnych

== Changelog ==

= 1.0.0 =
* Pierwsze wydanie
* Podstawowa funkcjonalność accordion
* Pełna konfiguracja przez panel widgetów
* Obsługa accessibility
* Responsywny design
* Zapamiętywanie stanu w localStorage

== Upgrade Notice ==

= 1.0.0 =
Pierwsza wersja pluginu.
