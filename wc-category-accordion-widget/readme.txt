=== WooCommerce Category Accordion Widget ===
Contributors: jklebucki
Tags: woocommerce, categories, accordion, widget, sidebar
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Nowoczesny widget wyświetlający kategorie produktów WooCommerce w formie interaktywnego accordion.

== Description ==

WooCommerce Category Accordion Widget to elegancki plugin dodający widget do wyświetlania kategorii produktów WooCommerce w formie rozwijalnej listy (accordion).

**Główne funkcje:**

* Interaktywny accordion z płynnymi animacjami
* Elegancki, minimalistyczny design
* Pełna konfiguracja przez panel widgetów
* Sortowanie kategorii według nazwy, liczby produktów, ID lub slug
* Opcjonalne wyświetlanie liczników produktów
* Hierarchiczne wyświetlanie podkategorii
* Zapamiętywanie stanu rozwiniętych kategorii
* Pełna obsługa accessibility (ARIA, nawigacja klawiaturą)
* Responsywny design
* Łatwe dostosowywanie kolorystyki

**Wymagania:**

* WooCommerce 3.0 lub nowszy

== Installation ==

1. Prześlij folder `wc-category-accordion-widget` do katalogu `/wp-content/plugins/`
2. Aktywuj plugin w menu 'Wtyczki' w WordPress
3. Przejdź do Wygląd → Widgety
4. Dodaj widget "Kategorie Produktów (Accordion)" do wybranego obszaru
5. Skonfiguruj opcje według potrzeb

== Frequently Asked Questions ==

= Czy plugin wymaga WooCommerce? =

Tak, plugin wymaga zainstalowanego i aktywnego WooCommerce w wersji 3.0 lub nowszej.

= Czy mogę zmienić kolorystykę? =

Tak, możesz edytować plik `assets/css/style.css` i zmienić wartości kolorów lub dodać własne style w pliku CSS motywu.

= Czy mogę użyć widgetu jako shortcode? =

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
