# WooCommerce Category Accordion Widget

## Changelog

### Version 1.0.0 (2025-11-25)

**Pierwsze wydanie**

#### Nowe funkcje
- Widget wyświetlający kategorie WooCommerce w formie accordion
- Pełna integracja z WooCommerce (taxonomy: product_cat)
- Panel konfiguracji w widgetach WordPress z opcjami:
  - Tytuł widgetu
  - Sortowanie (nazwa, liczba, ID, slug)
  - Kolejność (rosnąco/malejąco)
  - Wyświetlanie liczników produktów
  - Ukrywanie pustych kategorii
  - Hierarchiczne wyświetlanie podkategorii

#### Design & UX
- Minimalistyczny design w fioletowej kolorystyce (#7c3aed)
- Płynne animacje CSS (transitions, keyframes)
- Responsywny layout z breakpointami mobile
- Ikony rozwijania (› rotujące się o 90°)
- Hover states dla wszystkich interaktywnych elementów
- Focus states dla accessibility

#### JavaScript
- Vanilla JavaScript (bez zależności jQuery)
- Event delegation dla wydajności
- localStorage - zapamiętywanie stanu rozwiniętych kategorii
- Nawigacja klawiaturą (Space, Enter, Escape)
- ARIA attributes (aria-expanded, role="button")
- Screen reader support
- Custom event dla AJAX re-initialization

#### Techniczne
- WordPress Coding Standards
- Sanityzacja i walidacja danych
- Internationalization ready (text domain: wc-category-accordion-widget)
- Sprawdzanie czy WooCommerce jest aktywny
- Warunkowe ładowanie assets (tylko gdy widget aktywny)
- GPL v2 license

#### Pliki
- `wc-category-accordion-widget.php` - Główny plik pluginu
- `assets/css/style.css` - Arkusze stylów
- `assets/js/script.js` - Skrypty JavaScript
- `README.md` - Pełna dokumentacja
- `readme.txt` - WordPress repository format
- `LICENSE` - GPL v2 license

#### Wymagania
- WordPress 5.0+
- PHP 7.0+
- WooCommerce 3.0+

#### Znane ograniczenia
- Wsparcie tylko dla 2 poziomów hierarchii (główne kategorie + podkategorie)
- Brak wsparcia dla obrazków kategorii
- Brak built-in shortcode (wymaga dodania w functions.php)

---

## Planowane funkcje (Future releases)

### Version 1.1.0
- [ ] Wsparcie dla głębszej hierarchii (3+ poziomy)
- [ ] Obrazki kategorii (thumbnails)
- [ ] Built-in shortcode
- [ ] Kolory konfigurowalne przez panel admin
- [ ] Tryb grid/lista
- [ ] Animacje configurable

### Version 1.2.0
- [ ] Integracja z Gutenberg (block)
- [ ] Elementor widget
- [ ] WPBakery support
- [ ] AJAX filtering
- [ ] Live search

### Version 2.0.0
- [ ] Multi-level deep recursion
- [ ] Custom taxonomy support (nie tylko product_cat)
- [ ] Advanced styling options w admin
- [ ] Import/export ustawień
- [ ] Analytics tracking
