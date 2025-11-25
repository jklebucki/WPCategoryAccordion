# WooCommerce Category Accordion Widget

Nowoczesny widget WordPress wyświetlający kategorie produktów WooCommerce w formie interaktywnego accordion z eleganckim stylowaniem.

## Opis

Ten plugin dodaje do WordPress widget, który wyświetla kategorie produktów WooCommerce w formie rozwijalnej listy (accordion). Widget posiada:
- Elegancki, minimalistyczny design w fioletowej kolorystyce
- Płynne animacje rozwijania/zwijania
- Pełną obsługę dostępności (ARIA, klawiatura)
- Zapamiętywanie stanu rozwiniętych kategorii (localStorage)
- Pełną responsywność
- Konfigurowalne opcje wyświetlania

## Wymagania

- WordPress 5.0 lub nowszy
- PHP 7.0 lub nowszy
- WooCommerce 3.0 lub nowszy

## Instalacja

1. Pobierz folder `wc-category-accordion-widget`
2. Przenieś go do katalogu `/wp-content/plugins/`
3. Przejdź do panelu administracyjnego WordPress → Wtyczki
4. Znajdź "WooCommerce Category Accordion Widget" i kliknij "Aktywuj"

## Użycie

### Dodawanie widgetu

1. Przejdź do **Wygląd → Widgety** (lub **Wygląd → Dostosuj → Widgety**)
2. Znajdź widget **"Kategorie Produktów (Accordion)"**
3. Przeciągnij go do wybranego obszaru widgetów
4. Skonfiguruj opcje według potrzeb
5. Kliknij **Zapisz**

### Opcje konfiguracji

Widget oferuje następujące opcje:

- **Tytuł** - Nagłówek widgetu (domyślnie: "Kategorie Produktów")
- **Sortuj według** - Nazwa / Liczba produktów / ID / Slug
- **Kolejność** - Rosnąco / Malejąco
- **Pokaż licznik produktów** - Wyświetla liczbę produktów w każdej kategorii
- **Ukryj puste kategorie** - Ukrywa kategorie bez produktów
- **Pokaż podkategorie** - Włącza wyświetlanie hierarchii kategorii

## Dostosowywanie

### Zmiana kolorystyki

Edytuj plik `assets/css/style.css` i zmień następujące wartości:

```css
/* Kolor główny (fioletowy) */
#7c3aed → Twój kolor

/* Kolor tła przy rozwinięciu */
#faf5ff → Twój kolor

/* Kolor tła przy hover */
#f7fafc → Twój kolor
```

### Tryb pojedynczego rozwinięcia

Aby włączyć tryb, w którym tylko jedna kategoria może być rozwinięta jednocześnie, edytuj `assets/js/script.js` i odkomentuj zaznaczony fragment kodu (około linii 35):

```javascript
// Odkomentuj ten kod:
mainCategories.forEach(function(otherCategory) {
    if (otherCategory !== category && otherCategory.classList.contains('expanded')) {
        otherCategory.classList.remove('expanded');
    }
});
```

### Dodatkowe style

Możesz dodać własne style w pliku CSS motywu:

```css
/* Zmiana rozmiaru czcionki tytułu */
.widget.wc-category-accordion-widget .widget-title {
    font-size: 14px;
}

/* Zmiana paddingu kontenera */
.wc-category-accordion-widget__container {
    padding: 24px;
}
```

## Shortcode (opcjonalnie)

Jeśli chcesz użyć widgetu jako shortcode, dodaj do `functions.php` motywu:

```php
function wc_category_accordion_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Kategorie Produktów',
        'show_counts' => true,
        'hide_empty' => true,
    ), $atts);
    
    ob_start();
    the_widget('WC_Category_Accordion_Widget', $atts);
    return ob_get_clean();
}
add_shortcode('wc_categories', 'wc_category_accordion_shortcode');
```

Użycie:
```
[wc_categories title="Nasze Kategorie" show_counts="1"]
```

## Funkcje

### Accessibility

- Pełna obsługa czytników ekranu (ARIA labels)
- Nawigacja klawiaturą:
  - **Space/Enter** - rozwiń/zwiń kategorię
  - **Escape** - zwiń wszystkie kategorie
- Focus states dla elementów interaktywnych

### Responsywność

Widget automatycznie dostosowuje się do urządzeń mobilnych:
- Zmniejszone fonty na małych ekranach
- Zmniejszone odstępy
- Zachowanie pełnej funkcjonalności

### Zapamiętywanie stanu

Stan rozwiniętych kategorii jest zapisywany w localStorage przeglądarki, dzięki czemu jest zachowany między odświeżeniami strony.

## Rozwiązywanie problemów

### Widget nie wyświetla kategorii

1. Upewnij się, że WooCommerce jest aktywny
2. Sprawdź czy masz utworzone kategorie produktów w WooCommerce
3. Jeśli włączona jest opcja "Ukryj puste kategorie", upewnij się że kategorie zawierają produkty

### Style nie działają

1. Wyczyść cache przeglądarki i wtyczki cachującej
2. Sprawdź czy pliki CSS są prawidłowo załadowane (DevTools → Network)
3. Zwiększ specyficzność selektorów CSS dodając `!important` jeśli motyw nadpisuje style

### Accordion się nie rozwija

1. Sprawdź konsolę przeglądarki (F12) czy nie ma błędów JavaScript
2. Upewnij się że plik `assets/js/script.js` jest prawidłowo załadowany
3. Sprawdź czy kategorie mają podkategorie (opcja "Pokaż podkategorie" musi być włączona)

## Wsparcie

W razie problemów lub pytań:
- Sprawdź dokumentację WooCommerce
- Przejrzyj kod źródłowy w katalogu pluginu
- Skontaktuj się z autorem

## Licencja

GPL v2 lub nowsza - https://www.gnu.org/licenses/gpl-2.0.html

## Changelog

### 1.0.0
- Pierwsze wydanie
- Podstawowa funkcjonalność accordion
- Pełna konfiguracja przez panel widgetów
- Obsługa accessibility
- Responsywny design
