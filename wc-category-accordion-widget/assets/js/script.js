/**
 * WooCommerce Category Accordion Widget JavaScript
 * 
 * Obsługuje interaktywność accordion dla kategorii produktów
 * 
 * @package WC_Category_Accordion_Widget
 * @since 1.0.0
 */

(function() {
    'use strict';

    /**
     * Inicjalizacja accordion po załadowaniu DOM
     */
    function initCategoryAccordion() {
        // Znajdź wszystkie kategorie główne z subkategoriami
        const mainCategories = document.querySelectorAll(
            '.wc-category-accordion-list--depth-0 > .wc-category-accordion-list-item.has-children'
        );

        if (!mainCategories.length) {
            return;
        }

        mainCategories.forEach(function(category) {
            const link = category.querySelector('.wc-category-accordion-list-item__link');
            
            if (!link) {
                return;
            }

            // Dodaj event listener dla kliknięcia
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Toggle expanded class
                category.classList.toggle('expanded');
                
                // Opcjonalnie: zamknij inne otwarte kategorie (accordion behavior)
                // Odkomentuj poniższy kod dla trybu pojedynczego rozwinięcia
                /*
                mainCategories.forEach(function(otherCategory) {
                    if (otherCategory !== category && otherCategory.classList.contains('expanded')) {
                        otherCategory.classList.remove('expanded');
                    }
                });
                */

                // Accessibility: zmień aria-expanded
                const isExpanded = category.classList.contains('expanded');
                link.setAttribute('aria-expanded', isExpanded);
            });

            // Ustaw początkowy stan aria-expanded
            link.setAttribute('aria-expanded', 'false');
            link.setAttribute('role', 'button');
        });
    }

    /**
     * Zapisz/przywróć stan rozwinięcia w localStorage
     */
    function saveAccordionState() {
        const STORAGE_KEY = 'wc_category_accordion_state';

        // Zapisz stan
        function saveState() {
            const expanded = [];
            document.querySelectorAll('.wc-category-accordion-list-item.expanded').forEach(function(item) {
                const link = item.querySelector('.wc-category-accordion-list-item__link');
                if (link && link.href) {
                    expanded.push(link.href);
                }
            });
            
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(expanded));
            } catch (e) {
                // localStorage może być niedostępny
                console.warn('Could not save accordion state:', e);
            }
        }

        // Przywróć stan
        function restoreState() {
            try {
                const savedState = localStorage.getItem(STORAGE_KEY);
                if (!savedState) {
                    return;
                }

                const expandedUrls = JSON.parse(savedState);
                expandedUrls.forEach(function(url) {
                    const link = document.querySelector(
                        '.wc-category-accordion-list-item__link[href="' + url + '"]'
                    );
                    if (link) {
                        const item = link.closest('.wc-category-accordion-list-item');
                        if (item) {
                            item.classList.add('expanded');
                            link.setAttribute('aria-expanded', 'true');
                        }
                    }
                });
            } catch (e) {
                console.warn('Could not restore accordion state:', e);
            }
        }

        // Przywróć stan przy inicjalizacji
        restoreState();

        // Zapisz stan przy każdej zmianie
        document.addEventListener('click', function(e) {
            if (e.target.closest('.wc-category-accordion-list-item__link')) {
                setTimeout(saveState, 100);
            }
        });
    }

    /**
     * Obsługa klawiatury dla accessibility
     */
    function handleKeyboardNavigation() {
        document.addEventListener('keydown', function(e) {
            const target = e.target;
            
            if (!target.classList.contains('wc-category-accordion-list-item__link')) {
                return;
            }

            const item = target.closest('.wc-category-accordion-list-item');
            if (!item || !item.classList.contains('has-children')) {
                return;
            }

            // Space lub Enter - toggle accordion
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                target.click();
            }

            // Escape - zamknij wszystkie
            if (e.key === 'Escape') {
                document.querySelectorAll('.wc-category-accordion-list-item.expanded').forEach(function(expandedItem) {
                    expandedItem.classList.remove('expanded');
                    const link = expandedItem.querySelector('.wc-category-accordion-list-item__link');
                    if (link) {
                        link.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    }

    /**
     * Inicjalizacja po załadowaniu DOM
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initCategoryAccordion();
            saveAccordionState();
            handleKeyboardNavigation();
        });
    } else {
        initCategoryAccordion();
        saveAccordionState();
        handleKeyboardNavigation();
    }

    /**
     * Re-inicjalizacja po AJAX (dla dynamicznie ładowanej treści)
     */
    document.addEventListener('wc-category-accordion-refresh', function() {
        initCategoryAccordion();
        saveAccordionState();
    });

})();
