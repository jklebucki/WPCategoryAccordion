<?php
/**
 * Plugin Name: WooCommerce Category Accordion Widget
 * Plugin URI: https://github.com/jklebucki/WPCategoryAccordion
 * Description: Nowoczesny widget wyświetlający kategorie produktów WooCommerce w formie interaktywnego accordion z eleganckim stylowaniem
 * Version: 1.0.3
 * Author: Jarosław Kłębucki
 * Author URI: https://github.com/jklebucki
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-category-accordion-widget
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Requires Plugins: woocommerce
 * WC requires at least: 3.0.0
 * WC tested up to: 9.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('WC_CAT_ACCORDION_VERSION', '1.0.3');
define('WC_CAT_ACCORDION_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WC_CAT_ACCORDION_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Check if WooCommerce is active
 */
function wc_cat_accordion_check_woocommerce() {
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', 'wc_cat_accordion_woocommerce_missing_notice');
        return false;
    }
    return true;
}

/**
 * Admin notice if WooCommerce is not active
 */
function wc_cat_accordion_woocommerce_missing_notice() {
    ?>
    <div class="error">
        <p><?php _e('WooCommerce Category Accordion Widget wymaga zainstalowanego i aktywnego WooCommerce.', 'wc-category-accordion-widget'); ?></p>
    </div>
    <?php
}

/**
 * WooCommerce Category Accordion Widget Class
 */
class WC_Category_Accordion_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'wc_category_accordion_widget',
            __('Kategorie Produktów (Accordion)', 'wc-category-accordion-widget'),
            array(
                'description' => __('Wyświetla kategorie produktów WooCommerce w formie rozwijalnego accordion', 'wc-category-accordion-widget'),
                'classname' => 'wc-category-accordion-widget'
            )
        );
    }

    /**
     * Front-end display of widget
     */
    public function widget($args, $instance) {
        if (!class_exists('WooCommerce')) {
            return;
        }

        echo $args['before_widget'];

        // Pobierz ustawienia rozmiaru czcionki
        $title_font_size = isset($instance['title_font_size']) ? absint($instance['title_font_size']) : 18;
        $category_font_size = isset($instance['category_font_size']) ? absint($instance['category_font_size']) : 14;
        
        // Pobierz ustawienia kolorystyki
        $text_color = !empty($instance['text_color']) ? sanitize_hex_color($instance['text_color']) : '#2d3748';
        $hover_color = !empty($instance['hover_color']) ? sanitize_hex_color($instance['hover_color']) : '#7c3aed';
        $bg_color = !empty($instance['bg_color']) ? sanitize_hex_color($instance['bg_color']) : '#ffffff';
        $hover_bg_color = !empty($instance['hover_bg_color']) ? sanitize_hex_color($instance['hover_bg_color']) : '#f7fafc';
        $border_color = !empty($instance['border_color']) ? sanitize_hex_color($instance['border_color']) : '#e8e8e8';
        $count_bg_color = !empty($instance['count_bg_color']) ? sanitize_hex_color($instance['count_bg_color']) : '#e2e8f0';
        $count_text_color = !empty($instance['count_text_color']) ? sanitize_hex_color($instance['count_text_color']) : '#4a5568';
        $icon_color = !empty($instance['icon_color']) ? sanitize_hex_color($instance['icon_color']) : '#718096';
        $icon_active_color = !empty($instance['icon_active_color']) ? sanitize_hex_color($instance['icon_active_color']) : '#7c3aed';
        
        // Unikalne ID dla tego widgetu
        $widget_id = $args['widget_id'];

        if (!empty($instance['title'])) {
            $title_style = 'style="font-size: ' . esc_attr($title_font_size) . 'px;"';
            echo $args['before_title'] . '<span ' . $title_style . '>' . apply_filters('widget_title', $instance['title']) . '</span>' . $args['after_title'];
        }

        // Pobierz ustawienia
        $orderby = isset($instance['orderby']) ? $instance['orderby'] : 'name';
        $order = isset($instance['order']) ? $instance['order'] : 'ASC';
        $show_counts = isset($instance['show_counts']) ? (bool) $instance['show_counts'] : true;
        $hide_empty = isset($instance['hide_empty']) ? (bool) $instance['hide_empty'] : true;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : true;

        // Pobierz kategorie produktów
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'orderby' => $orderby,
            'order' => $order,
            'hide_empty' => $hide_empty,
            'parent' => 0 // Tylko kategorie główne
        ));

        if (!empty($categories) && !is_wp_error($categories)) {
            // Dodaj inline style dla rozmiaru czcionki i kolorystyki
            echo '<style>';
            // Rozmiary czcionek
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item__link { font-size: ' . esc_attr($category_font_size) . 'px !important; }';
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item-count { font-size: ' . esc_attr(max(10, $category_font_size - 2)) . 'px !important; }';
            
            // Kolorystyka kontenera
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-widget__container { background: ' . esc_attr($bg_color) . ' !important; border-color: ' . esc_attr($border_color) . ' !important; }';
            
            // Kolorystyka tekstu kategorii
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item__link { color: ' . esc_attr($text_color) . ' !important; }';
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item__link:hover { color: ' . esc_attr($hover_color) . ' !important; }';
            
            // Kolorystyka tła przy hover
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list--depth-0 > .wc-category-accordion-list-item:hover { background-color: ' . esc_attr($hover_bg_color) . ' !important; }';
            
            // Kolorystyka licznika
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item-count { background-color: ' . esc_attr($count_bg_color) . ' !important; color: ' . esc_attr($count_text_color) . ' !important; }';
            
            // Kolorystyka ikony
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list--depth-0 > .wc-category-accordion-list-item.has-children > .wc-category-accordion-list-item__link::before { color: ' . esc_attr($icon_color) . ' !important; }';
            echo '#' . esc_attr($widget_id) . ' .wc-category-accordion-list-item.expanded > .wc-category-accordion-list-item__link::before { color: ' . esc_attr($icon_active_color) . ' !important; }';
            
            echo '</style>';
            
            echo '<div class="wc-category-accordion-widget__container">';
            echo '<ul class="wc-category-accordion-list wc-category-accordion-list--depth-0">';
            
            foreach ($categories as $category) {
                $this->display_category($category, $show_counts, $hierarchical, $hide_empty);
            }
            
            echo '</ul>';
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    /**
     * Wyświetl pojedynczą kategorię
     */
    private function display_category($category, $show_counts = true, $hierarchical = true, $hide_empty = true) {
        $category_link = get_term_link($category);
        $has_children = false;
        $children = array();

        // Sprawdź czy ma podkategorie
        if ($hierarchical) {
            $children = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => $hide_empty,
                'parent' => $category->term_id
            ));
            $has_children = !empty($children) && !is_wp_error($children);
        }

        $li_class = 'wc-category-accordion-list-item';
        if ($has_children) {
            $li_class .= ' has-children';
        }

        echo '<li class="' . esc_attr($li_class) . '">';
        
        // Link do kategorii
        echo '<a href="' . esc_url($category_link) . '" class="wc-category-accordion-list-item__link">';
        echo '<span class="wc-category-accordion-list-item__name">' . esc_html($category->name) . '</span>';
        echo '</a>';

        // Licznik produktów
        if ($show_counts) {
            echo '<span class="wc-category-accordion-list-item-count">';
            echo '<span aria-hidden="true">' . absint($category->count) . '</span>';
            echo '<span class="screen-reader-text">' . sprintf(_n('%s produkt', '%s produktów', $category->count, 'wc-category-accordion-widget'), number_format_i18n($category->count)) . '</span>';
            echo '</span>';
        }

        // Wyświetl podkategorie
        if ($has_children) {
            echo '<ul class="wc-category-accordion-list wc-category-accordion-list--depth-1">';
            foreach ($children as $child) {
                $this->display_subcategory($child, $show_counts);
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    /**
     * Wyświetl podkategorię
     */
    private function display_subcategory($category, $show_counts = true) {
        $category_link = get_term_link($category);

        echo '<li class="wc-category-accordion-list-item">';
        
        echo '<a href="' . esc_url($category_link) . '" class="wc-category-accordion-list-item__link">';
        echo '<span class="wc-category-accordion-list-item__name">' . esc_html($category->name) . '</span>';
        echo '</a>';

        if ($show_counts) {
            echo '<span class="wc-category-accordion-list-item-count">';
            echo '<span aria-hidden="true">' . absint($category->count) . '</span>';
            echo '<span class="screen-reader-text">' . sprintf(_n('%s produkt', '%s produktów', $category->count, 'wc-category-accordion-widget'), number_format_i18n($category->count)) . '</span>';
            echo '</span>';
        }

        echo '</li>';
    }

    /**
     * Back-end widget form
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Kategorie Produktów', 'wc-category-accordion-widget');
        $orderby = !empty($instance['orderby']) ? $instance['orderby'] : 'name';
        $order = !empty($instance['order']) ? $instance['order'] : 'ASC';
        $show_counts = isset($instance['show_counts']) ? (bool) $instance['show_counts'] : true;
        $hide_empty = isset($instance['hide_empty']) ? (bool) $instance['hide_empty'] : true;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : true;
        $title_font_size = !empty($instance['title_font_size']) ? absint($instance['title_font_size']) : 18;
        $category_font_size = !empty($instance['category_font_size']) ? absint($instance['category_font_size']) : 14;
        
        // Ustawienia kolorystyki
        $text_color = !empty($instance['text_color']) ? $instance['text_color'] : '#2d3748';
        $hover_color = !empty($instance['hover_color']) ? $instance['hover_color'] : '#7c3aed';
        $bg_color = !empty($instance['bg_color']) ? $instance['bg_color'] : '#ffffff';
        $hover_bg_color = !empty($instance['hover_bg_color']) ? $instance['hover_bg_color'] : '#f7fafc';
        $border_color = !empty($instance['border_color']) ? $instance['border_color'] : '#e8e8e8';
        $count_bg_color = !empty($instance['count_bg_color']) ? $instance['count_bg_color'] : '#e2e8f0';
        $count_text_color = !empty($instance['count_text_color']) ? $instance['count_text_color'] : '#4a5568';
        $icon_color = !empty($instance['icon_color']) ? $instance['icon_color'] : '#718096';
        $icon_active_color = !empty($instance['icon_active_color']) ? $instance['icon_active_color'] : '#7c3aed';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('Tytuł:', 'wc-category-accordion-widget'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                <?php _e('Sortuj według:', 'wc-category-accordion-widget'); ?>
            </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
                <option value="name" <?php selected($orderby, 'name'); ?>><?php _e('Nazwa', 'wc-category-accordion-widget'); ?></option>
                <option value="count" <?php selected($orderby, 'count'); ?>><?php _e('Liczba produktów', 'wc-category-accordion-widget'); ?></option>
                <option value="id" <?php selected($orderby, 'id'); ?>><?php _e('ID', 'wc-category-accordion-widget'); ?></option>
                <option value="slug" <?php selected($orderby, 'slug'); ?>><?php _e('Slug', 'wc-category-accordion-widget'); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <?php _e('Kolejność:', 'wc-category-accordion-widget'); ?>
            </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('order')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('order')); ?>">
                <option value="ASC" <?php selected($order, 'ASC'); ?>><?php _e('Rosnąco', 'wc-category-accordion-widget'); ?></option>
                <option value="DESC" <?php selected($order, 'DESC'); ?>><?php _e('Malejąco', 'wc-category-accordion-widget'); ?></option>
            </select>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_counts); ?> 
                   id="<?php echo esc_attr($this->get_field_id('show_counts')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('show_counts')); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('show_counts')); ?>">
                <?php _e('Pokaż licznik produktów', 'wc-category-accordion-widget'); ?>
            </label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($hide_empty); ?> 
                   id="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('hide_empty')); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>">
                <?php _e('Ukryj puste kategorie', 'wc-category-accordion-widget'); ?>
            </label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($hierarchical); ?> 
                   id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>">
                <?php _e('Pokaż podkategorie', 'wc-category-accordion-widget'); ?>
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title_font_size')); ?>">
                <?php _e('Wielkość czcionki tytułu (px):', 'wc-category-accordion-widget'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('title_font_size')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title_font_size')); ?>" 
                   type="number" min="10" max="48" step="1" value="<?php echo esc_attr($title_font_size); ?>">
            <small><?php _e('Domyślnie: 18px', 'wc-category-accordion-widget'); ?></small>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category_font_size')); ?>">
                <?php _e('Wielkość czcionki kategorii (px):', 'wc-category-accordion-widget'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('category_font_size')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('category_font_size')); ?>" 
                   type="number" min="10" max="32" step="1" value="<?php echo esc_attr($category_font_size); ?>">
            <small><?php _e('Domyślnie: 14px', 'wc-category-accordion-widget'); ?></small>
        </p>

        <hr style="margin: 20px 0;">
        <h4 style="margin: 10px 0;"><?php _e('Kolorystyka', 'wc-category-accordion-widget'); ?></h4>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text_color')); ?>">
                <?php _e('Kolor tekstu kategorii:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('text_color')); ?>" 
                   type="color" value="<?php echo esc_attr($text_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hover_color')); ?>">
                <?php _e('Kolor tekstu przy najechaniu:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('hover_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('hover_color')); ?>" 
                   type="color" value="<?php echo esc_attr($hover_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('bg_color')); ?>">
                <?php _e('Kolor tła kontenera:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('bg_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('bg_color')); ?>" 
                   type="color" value="<?php echo esc_attr($bg_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hover_bg_color')); ?>">
                <?php _e('Kolor tła przy najechaniu:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('hover_bg_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('hover_bg_color')); ?>" 
                   type="color" value="<?php echo esc_attr($hover_bg_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('border_color')); ?>">
                <?php _e('Kolor ramki:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('border_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('border_color')); ?>" 
                   type="color" value="<?php echo esc_attr($border_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count_bg_color')); ?>">
                <?php _e('Kolor tła licznika:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count_bg_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('count_bg_color')); ?>" 
                   type="color" value="<?php echo esc_attr($count_bg_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count_text_color')); ?>">
                <?php _e('Kolor tekstu licznika:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count_text_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('count_text_color')); ?>" 
                   type="color" value="<?php echo esc_attr($count_text_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon_color')); ?>">
                <?php _e('Kolor ikony accordion:', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('icon_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('icon_color')); ?>" 
                   type="color" value="<?php echo esc_attr($icon_color); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon_active_color')); ?>">
                <?php _e('Kolor ikony (rozwinięta):', 'wc-category-accordion-widget'); ?>
            </label><br>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('icon_active_color')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('icon_active_color')); ?>" 
                   type="color" value="<?php echo esc_attr($icon_active_color); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['orderby'] = (!empty($new_instance['orderby'])) ? sanitize_text_field($new_instance['orderby']) : 'name';
        $instance['order'] = (!empty($new_instance['order'])) ? sanitize_text_field($new_instance['order']) : 'ASC';
        $instance['show_counts'] = !empty($new_instance['show_counts']) ? 1 : 0;
        $instance['hide_empty'] = !empty($new_instance['hide_empty']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['title_font_size'] = (!empty($new_instance['title_font_size'])) ? absint($new_instance['title_font_size']) : 18;
        $instance['category_font_size'] = (!empty($new_instance['category_font_size'])) ? absint($new_instance['category_font_size']) : 14;
        
        // Kolorystyka
        $instance['text_color'] = (!empty($new_instance['text_color'])) ? sanitize_hex_color($new_instance['text_color']) : '#2d3748';
        $instance['hover_color'] = (!empty($new_instance['hover_color'])) ? sanitize_hex_color($new_instance['hover_color']) : '#7c3aed';
        $instance['bg_color'] = (!empty($new_instance['bg_color'])) ? sanitize_hex_color($new_instance['bg_color']) : '#ffffff';
        $instance['hover_bg_color'] = (!empty($new_instance['hover_bg_color'])) ? sanitize_hex_color($new_instance['hover_bg_color']) : '#f7fafc';
        $instance['border_color'] = (!empty($new_instance['border_color'])) ? sanitize_hex_color($new_instance['border_color']) : '#e8e8e8';
        $instance['count_bg_color'] = (!empty($new_instance['count_bg_color'])) ? sanitize_hex_color($new_instance['count_bg_color']) : '#e2e8f0';
        $instance['count_text_color'] = (!empty($new_instance['count_text_color'])) ? sanitize_hex_color($new_instance['count_text_color']) : '#4a5568';
        $instance['icon_color'] = (!empty($new_instance['icon_color'])) ? sanitize_hex_color($new_instance['icon_color']) : '#718096';
        $instance['icon_active_color'] = (!empty($new_instance['icon_active_color'])) ? sanitize_hex_color($new_instance['icon_active_color']) : '#7c3aed';

        return $instance;
    }
}

/**
 * Register widget
 */
function wc_cat_accordion_register_widget() {
    if (wc_cat_accordion_check_woocommerce()) {
        register_widget('WC_Category_Accordion_Widget');
    }
}
add_action('widgets_init', 'wc_cat_accordion_register_widget');

/**
 * Enqueue styles and scripts for the widget
 */
function wc_cat_accordion_enqueue_assets() {
    // Sprawdź czy widget jest aktywny
    if (is_active_widget(false, false, 'wc_category_accordion_widget', true)) {
        wp_enqueue_style(
            'wc-category-accordion-widget',
            WC_CAT_ACCORDION_PLUGIN_URL . 'assets/css/style.css',
            array(),
            WC_CAT_ACCORDION_VERSION
        );

        wp_enqueue_script(
            'wc-category-accordion-widget',
            WC_CAT_ACCORDION_PLUGIN_URL . 'assets/js/script.js',
            array(),
            WC_CAT_ACCORDION_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'wc_cat_accordion_enqueue_assets');

/**
 * Load plugin textdomain
 */
function wc_cat_accordion_load_textdomain() {
    load_plugin_textdomain(
        'wc-category-accordion-widget',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}
add_action('plugins_loaded', 'wc_cat_accordion_load_textdomain');

/**
 * Add settings link on plugin page
 */
function wc_cat_accordion_add_settings_link($links) {
    $settings_link = '<a href="' . admin_url('widgets.php') . '">' . __('Ustawienia', 'wc-category-accordion-widget') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wc_cat_accordion_add_settings_link');

/**
 * Declare HPOS compatibility
 */
add_action('before_woocommerce_init', function() {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});
