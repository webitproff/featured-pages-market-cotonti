# Featured Articles in Market PRO

 ## 🇬🇧 
 **Featured Articles in Market PRO** is a plugin for **CMF Cotonti Siena v0.9.26+** that allows you to manually assign and display featured (recommended) articles (pages) on **Market PRO** product pages.

The plugin adds an article selection interface to the product edit form and outputs the selected articles on the public product page.
 - **Required: [Module Market PRO v.5+ by webitproff](https://github.com/webitproff/marketpro-cotonti/)**

[![Required: Module Market PRO v.5](https://img.shields.io/badge/Required-Module_Market_PRO_.5-green.svg)](https://github.com/webitproff/marketpro-cotonti/)
[![Cotonti Compatibility](https://img.shields.io/badge/Cotonti_Siena-0.9.26-orange.svg)](https://github.com/Cotonti/Cotonti)
[![PHP](https://img.shields.io/badge/PHP-8.4-purple.svg)](https://www.php.net/releases/8_4_0.php)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue.svg)](https://www.mysql.com/)
[![Bootstrap v5.3.8](https://img.shields.io/badge/Bootstrap-v5.3.8-blueviolet.svg)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/license-BSD-blue.svg)](https://github.com/webitproff/marketpro-cotonti/blob/main/LICENSE)
---

![featured-pages-market-cotonti_main](https://github.com/user-attachments/assets/5f427616-8feb-4d7a-954d-2c6d8f83bec0)

## Compatibility

* **Cotonti Siena**: 0.9.26+
* **PHP**: 8.4+
* **MySQL**: 8.0+
* **Market PRO**: v5+
* **Bootstrap**: used in templates (optional)

---

## Dependencies

### Required

* `page` module
* `market` module

### Recommended

* `attacher` plugin — to retrieve article images
* `i18n` plugin — for multilingual websites (supported automatically)

---

## Key Features

* Manual assignment of featured articles for each product
* Limit on the number of related articles via plugin settings
* AJAX-based article search using **Select2**
* Multilingual support via the `i18n` plugin
* Automatic retrieval of the first attached article image
* Fallback image if no article image exists
* Page data caching within a single request
* Automatic cleanup of relations when a product is deleted

---

## Architecture and Logic

### Relations Table

The plugin uses a dedicated relations table:

```sql
cot_featured_pag_mrkt
```

| Field         | Description               |
| ------------- | ------------------------- |
| fartc_id      | Relation ID               |
| fartc_from_id | Market product ID         |
| fartc_to_id   | Related article (page) ID |
| fartc_order   | Display order             |

* Unique relation per product–article pair
* Supports ordering
* Uses InnoDB and utf8mb4

---

## Plugin Configuration

| Option                      | Description                         |
| --------------------------- | ----------------------------------- |
| `maxitems_page`             | Maximum number of featured articles |
| `max_select_itemslist_page` | AJAX search result limit            |
| `desc_length_page`          | Article description length          |
| `nonimage_page`             | Path to fallback image              |

---

## Product Edit Interface

### Hook

```
market.edit.tags
```

### Functionality

* Article selection via Select2 (AJAX)
* Search starts after entering 2 characters
* Current product is excluded from results
* Non-admin users can select only their own articles
* Values are stored in hidden input fields
* Preselected values are supported

---

## AJAX Article Search

### File

```
featuredpagesmarket.ajax.php
```

### Query Conditions

* `page_state = 0`
* Search by `page_title`
* Excludes the current article
* Author restriction for non-admin users
* Result count limit

Returns JSON compatible with Select2.

---

## Saving Relations

### Hook

```
market.edit.update.done
```

### Logic

* All existing relations are removed before saving
* Validation includes:

  * Article existence
  * Published state (`page_state = 0`)
  * Duplicate prevention
* Respects the `maxitems_page` limit
* Order is saved using `fartc_order`

---

## Deleting Relations

### Hook

```
market.edit.delete.done
```

When a product is deleted:

* All relations where the product is either the source or the target are removed

---

## Public Output on Product Page

### Hook

```
market.tags
```

### Features

* Retrieves related articles
* Preserves manual ordering
* `i18n` support:

  * Article titles
  * Descriptions
  * Category titles
* URL generation via alias or ID
* Article image retrieval
* Cleaned and truncated description text

---

## Text Cleaning

Function:

```php
featuredpagesmarket_descriptionText_cleaning()
```

Performs:

* HTML tag replacement with spaces
* `strip_tags`
* HTML entity decoding
* Whitespace normalization
* Safe text preparation for previews

---

## Templates

### Admin Area

```
featuredpagesmarket.edit.tpl
```

Used in `market.edit.tpl`

### Public Area

```
featuredpagesmarket.market.articles.tpl
```

Used in `market.tpl`

Both templates:

* Are theme-independent
* Use standard Bootstrap classes
* Can be overridden in the site theme

---

## Template Integration

### `market.edit.tpl`

```tpl
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} -->
<!-- IF {PHP|cot_auth('plug', 'featuredpagesmarket', 'W')} -->
{FEATUREDPRO_ARTICLES_EDIT}
<!-- ENDIF -->
<!-- ENDIF -->
```

### `market.tpl`

```tpl
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} AND {FEATUREDPRO_ARTICLES_TRUE} -->
{FEATUREDPRO_ARTICLES_PAGES}
<!-- ENDIF -->
```

---

## Security

* `COT_CODE` check in all files
* Permission checks
* Input filtering
* Prepared SQL statements
* Escaped HTML output

---

## License

BSD License

---

## Author

**webitproff**
GitHub: [https://github.com/webitproff](https://github.com/webitproff)
Date: Jan 22Th, 2026

**The plugin's page on [Cotonti Extensions Store](https://abuyfile.com/ru/market/cotonti/plugs/featured-pages-market)**
___



# Рекомендуемые статьи и страницы в карточке товара
## 🇷🇺 
**Featured Articles in Market PRO** — плагин для CMF **Cotonti Siena v0.9.26+**, который позволяет вручную назначать и отображать рекомендуемые статьи (pages) на странице товара модуля **Market PRO**.

Плагин добавляет интерфейс выбора статей при редактировании товара и выводит связанные статьи в карточке товара на публичной части сайта.
 - **Требуется: [Module Market PRO v.5+ by webitproff](https://github.com/webitproff/marketpro-cotonti/).**

[![Required: Module Market PRO v.5](https://img.shields.io/badge/Required-Module_Market_PRO_.5-green.svg)](https://github.com/webitproff/marketpro-cotonti/)
[![Cotonti Compatibility](https://img.shields.io/badge/Cotonti_Siena-0.9.26-orange.svg)](https://github.com/Cotonti/Cotonti)
[![PHP](https://img.shields.io/badge/PHP-8.4-purple.svg)](https://www.php.net/releases/8_4_0.php)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue.svg)](https://www.mysql.com/)
[![Bootstrap v5.3.8](https://img.shields.io/badge/Bootstrap-v5.3.8-blueviolet.svg)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/license-BSD-blue.svg)](https://github.com/webitproff/marketpro-cotonti/blob/main/LICENSE)
---

## Совместимость

- **Cotonti Siena**: 0.9.26+
- **PHP**: 8.4+
- **MySQL**: 8.0+
- **Market PRO**: v5+
- **Bootstrap**: используется в шаблонах (опционально)

---

## Зависимости

### Обязательные
- Модуль `page`
- Модуль `market`

### Рекомендуемые
- Плагин `attacher` — для получения изображений статей
- Плагин `i18n` — для мультиязычных сайтов (поддерживается автоматически)

---

## Основные возможности

- Ручное назначение рекомендуемых статей для каждого товара
- Ограничение количества связанных статей через настройки плагина
- AJAX-поиск статей с использованием **Select2**
- Поддержка мультиязычных сайтов (через `i18n`)
- Получение первого изображения статьи (через `attacher`)
- Fallback-изображение при отсутствии картинки
- Кэширование данных страниц в рамках запроса
- Корректная очистка связей при удалении товара

---

## Архитектура и логика работы

### Таблица связей

Плагин использует отдельную таблицу связей:

```sql
cot_featured_pag_mrkt
````

| Поле          | Назначение                 |
| ------------- | -------------------------- |
| fartc_id      | ID записи                  |
| fartc_from_id | ID товара (market)         |
| fartc_to_id   | ID связанной статьи (page) |
| fartc_order   | Порядок вывода             |

* Связь **уникальна** (`from_id + to_id`)
* Поддерживается сортировка
* Используется InnoDB и utf8mb4

---

## Настройки плагина

| Параметр                    | Описание                                     |
| --------------------------- | -------------------------------------------- |
| `maxitems_page`             | Максимальное количество рекомендуемых статей |
| `max_select_itemslist_page` | Лимит элементов в AJAX-поиске                |
| `desc_length_page`          | Длина описания статьи                        |
| `nonimage_page`             | Путь к изображению-заглушке                  |

---

## Интерфейс редактирования товара

### Хук

```
market.edit.tags
```

### Возможности

* Выбор статей через Select2 (AJAX)
* Поиск начинается с 2 символов
* Исключается текущий товар
* Для не-администраторов — только собственные статьи
* Значения сохраняются в скрытых input-полях
* Поддержка предварительно выбранных значений

---

## AJAX-поиск статей

### Файл

```
featuredpagesmarket.ajax.php
```

### Условия выборки

* `page_state = 0`
* Поиск по `page_title`
* Исключение текущей статьи
* Ограничение по автору (если не администратор)
* Ограничение количества результатов

Ответ возвращается в формате JSON, совместимом с Select2.

---

## Сохранение связей

### Хук

```
market.edit.update.done
```

### Логика

* Старые связи удаляются полностью
* Проверяется:

  * существование статьи
  * публикация (`page_state = 0`)
  * отсутствие дубликатов
* Соблюдается лимит `maxitems_page`
* Порядок сохраняется через `fartc_order`

---

## Удаление связей

### Хук

```
market.edit.delete.done
```

При удалении товара:

* удаляются все связи, где товар участвует как `from` или `to`

---

## Публичный вывод в карточке товара

### Хук

```
market.tags
```

### Возможности

* Получение связанных статей
* Учет порядка сортировки
* Поддержка `i18n`:

  * перевод заголовков
  * перевод описаний
  * перевод категорий
* Формирование URL через `alias` или `id`
* Получение изображения статьи
* Очистка и обрезка текста описания

---

## Очистка текста

Функция:

```
featuredpagesmarket_descriptionText_cleaning()
```

Выполняет:

* замену HTML-тегов на пробелы
* `strip_tags`
* декодирование HTML-сущностей
* нормализацию пробелов
* безопасную подготовку текста для превью

---

## Шаблоны

### Админка

```
featuredpagesmarket.edit.tpl
```

Используется в `market.edit.tpl`

### Публичная часть

```
featuredpagesmarket.market.articles.tpl
```

Используется в `market.tpl`

Оба шаблона:

* не зависят от темы
* используют стандартные Bootstrap-классы
* легко переопределяются в теме

---

## Интеграция в шаблоны

### `market.edit.tpl`

```tpl
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} -->
<!-- IF {PHP|cot_auth('plug', 'featuredpagesmarket', 'W')} -->
{FEATUREDPRO_ARTICLES_EDIT}
<!-- ENDIF -->
<!-- ENDIF -->
```

### `market.tpl`

```tpl
<!-- IF {PHP|cot_plugin_active('featuredpagesmarket')} AND {FEATUREDPRO_ARTICLES_TRUE} -->
{FEATUREDPRO_ARTICLES_PAGES}
<!-- ENDIF -->
```

---

## Безопасность

* Проверка `COT_CODE` во всех файлах
* Проверка прав доступа
* Фильтрация входных данных
* Подготовленные SQL-запросы
* Экранирование HTML-вывода

---

## Лицензия

BSD License

---

## Автор

**webitproff**
GitHub: [https://github.com/webitproff](https://github.com/webitproff)


---

Date: Jan 22Th, 2026
Страница плагина на [Cotonti Extensions Store](https://abuyfile.com/ru/market/cotonti/plugs/featured-pages-market)

