# Instrukcja dodawania tłumaczeń / Translation Guide

## Polski

### Jak dodać tłumaczenie dla nowego języka

Plugin wspiera tłumaczenia poprzez standardowy system WordPress i-18n. Poniżej znajdziesz trzy metody dodawania tłumaczeń.

#### Metoda 1: Używając wtyczki Loco Translate (Zalecane)

1. Zainstaluj i aktywuj wtyczkę [Loco Translate](https://wordpress.org/plugins/loco-translate/)
2. Przejdź do **Loco Translate → Wtyczki**
3. Wybierz **WooCommerce Category Accordion Widget**
4. Kliknij **Nowy język**
5. Wybierz swój język i kliknij **Rozpocznij tłumaczenie**
6. Przetłumacz wszystkie ciągi tekstowe i zapisz

#### Metoda 2: Używając WPML

1. Zainstaluj i aktywuj [WPML](https://wpml.org/)
2. Przejdź do **WPML → Lokalizacja motywów i wtyczek**
3. Znajdź **WooCommerce Category Accordion Widget**
4. Kliknij **Skanuj w poszukiwaniu ciągów**
5. Tłumacz ciągi w swoim języku

#### Metoda 3: Ręcznie za pomocą Poedit

1. Pobierz i zainstaluj [Poedit](https://poedit.net/)
2. Otwórz plik `/wp-content/plugins/wc-category-accordion-widget/languages/wc-category-accordion-widget.pot`
3. Wybierz **Utwórz nowe tłumaczenie**
4. Wybierz swój język
5. Przetłumacz wszystkie ciągi
6. Zapisz jako `wc-category-accordion-widget-{locale}.po` (np. `wc-category-accordion-widget-de_DE.po`)
7. Poedit automatycznie wygeneruje plik `.mo`
8. Prześlij oba pliki do folderu `languages`

---

## English

### How to add translation for a new language

The plugin supports translations via the standard WordPress i18n system. Below you'll find three methods for adding translations.

#### Method 1: Using Loco Translate Plugin (Recommended)

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

#### Method 3: Manually with Poedit

1. Download and install [Poedit](https://poedit.net/)
2. Open the file `/wp-content/plugins/wc-category-accordion-widget/languages/wc-category-accordion-widget.pot`
3. Choose **Create new translation**
4. Select your language
5. Translate all strings
6. Save as `wc-category-accordion-widget-{locale}.po` (e.g., `wc-category-accordion-widget-de_DE.po`)
7. Poedit will automatically generate the `.mo` file
8. Upload both files to the `languages` folder

---

## Locale Codes / Kody lokalizacji

Common language codes / Popularne kody języków:

- English (US): `en_US`
- English (UK): `en_GB`
- Polish: `pl_PL`
- German: `de_DE`
- French: `fr_FR`
- Spanish: `es_ES`
- Italian: `it_IT`
- Portuguese (Brazil): `pt_BR`
- Dutch: `nl_NL`
- Russian: `ru_RU`
- Chinese (Simplified): `zh_CN`
- Japanese: `ja`

## Contributing Translations / Współtworzenie tłumaczeń

If you create a translation for this plugin, please consider sharing it by:
- Creating a pull request on [GitHub](https://github.com/jklebucki/WPCategoryAccordion)
- Contacting the author

Jeśli stworzysz tłumaczenie dla tego pluginu, rozważ udostępnienie go poprzez:
- Utworzenie pull request na [GitHub](https://github.com/jklebucki/WPCategoryAccordion)
- Kontakt z autorem
