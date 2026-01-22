<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.tags
 * Tags=market.tpl:{FEATUREDPRO_ARTICLES_PAGES}
 * [END_COT_EXT]
 */
/**
 * featuredpagesmarket.market.tags.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredpagesmarket.market.tags.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
// Этот файл является точкой входа для подключения тегов плагина Featured Articles in Market PRO в шаблон страницы (market.tpl)
// Регистрируется через хук market.tags и отвечает за генерацию блока {FEATUREDPRO_ARTICLES_PAGES} в шаблоне
// Основная задача — выводить список специально назначенных, "вручную" заданных, рекомендуемых статей (pages) для текущего товара market
// Защита от прямого обращения к файлу через браузер — стандартная проверка Cotonti
defined('COT_CODE') or die('Wrong URL');

// Объявляем глобальные объекты базы данных и таблиц, которые будем использовать в этом скрипте
// $db_i18n_pages — для поддержки многоязычных переводов страниц (плагин i18n)
// $db_i18n_structure — для переводов категорий
global $db, $db_pages, $db_users, $db_i18n_pages, $db_structure, $db_i18n_structure, $cfg, $db_x;

// Подключаем основной файл функций и настроек плагина Featured Articles in Market PRO
require_once cot_incfile('featuredpagesmarket', 'plug');

// Инициализируем переменные, которые будут хранить основную информацию о текущем товаре
$page_id = 0;
$current_locale = Cot::$usr['lang'] ?? Cot::$cfg['defaultlang']; // Текущий язык пользователя или дефолтный из конфига

// Получаем ID текущего товара market
// В модуле market ID хранится в поле fieldmrkt_id (не item_id!)
if (isset($item) && is_array($item)) {
    $page_id = isset($item['fieldmrkt_id']) ? (int)$item['fieldmrkt_id'] : 0;
}

// Дополнительная проверка на случай, если ID пришёл через GET (редко, но бывает)
if ($page_id < 1 && !empty($_GET['id'])) {
    $page_id = (int)cot_import($_GET['id'], 'G', 'INT');
}

// Если ID не найден — выходим, чтобы не делать бесполезный запрос
if ($page_id < 1) {
    return;
}

// Если активен плагин i18n и язык не дефолтный — пытаемся подгрузить перевод самого товара
// (это может понадобиться, если где-то дальше используются title/desc/text товара)
if (cot_plugin_active('i18n') && $current_locale !== Cot::$cfg['defaultlang'] && $page_id > 0) {
    $translation = $db->query(
        "SELECT ipage_title, ipage_desc, ipage_text
         FROM $db_i18n_pages
         WHERE ipage_id = ? AND ipage_locale = ?",
        [$page_id, $current_locale]
    )->fetch(PDO::FETCH_ASSOC);

    if ($translation) {
        if (!empty($translation['ipage_title'])) $item['fieldmrkt_title'] = $translation['ipage_title'];
        if (!empty($translation['ipage_desc']))  $item['fieldmrkt_desc']  = $translation['ipage_desc'];
        if (!empty($translation['ipage_text']))  $item['fieldmrkt_text']  = $translation['ipage_text'];
    }
}

// Формируем имя таблицы связей
$table = $db_x . 'featured_pag_mrkt';

// Читаем из конфига максимальное количество статей и длину описания
$max_page = (int) ($cfg['plugin']['featuredpagesmarket']['maxitems_page'] ?? 5);
$desc_len = (int) ($cfg['plugin']['featuredpagesmarket']['desc_length_page'] ?? 160);
if ($desc_len < 40) $desc_len = 120;

// Инициализируем массив для связанных статей
$featured_articles = [];

// Проверяем наличие категории у товара — без неё нет смысла искать связи
if (isset($item['fieldmrkt_cat']) && !empty($item['fieldmrkt_cat'])) {
    // Основной запрос: получаем связанные статьи (pages) через таблицу связей
    // Учитываем только опубликованные страницы (page_state = 0), сортируем по порядку
    $featured_articles = $db->query(
        "SELECT
            p.page_id,
            p.page_title,
            p.page_desc,
            p.page_text,
            p.page_cat,
            p.page_alias
         FROM $table fartc
         INNER JOIN $db_pages p ON p.page_id = fartc.fartc_to_id
         WHERE fartc.fartc_from_id = ?
           AND p.page_state = 0
         ORDER BY fartc.fartc_order ASC
         LIMIT ?",
        [$page_id, $max_page]
    )->fetchAll();
}

// Присваиваем шаблону имя части и локации расширения
$tpl_ExtCode = 'featuredpagesmarket';     // Код расширения
$tpl_PartExt = 'market';          // Область (модуль)
$tpl_PartExtSecond = 'articles';  // Конкретная локация (статьи)

// Загружаем шаблон featuredpagesmarket.market.articles.tpl
$mskin = cot_tplfile([$tpl_ExtCode, $tpl_PartExt, $tpl_PartExtSecond], 'plug', true);

// Создаём объект XTemplate для вставки в {FEATUREDPRO_ARTICLES_PAGES}
$tt = new XTemplate($mskin);

// Если статьи найдены — готовим блок
if (!empty($featured_articles)) {
    // Устанавливаем флаг (булевый маячок) наличия статей (можно использовать в шаблоне для IF)
    $t->assign('FEATUREDPRO_ARTICLES_TRUE', true);

    // Проходим по каждой связанной статье
    foreach ($featured_articles as $featured_article) {
        $featured_id = (int)($featured_article['page_id'] ?? 0);

        // Если i18n активен и язык не дефолтный — подгружаем перевод статьи
        if (cot_plugin_active('i18n') && $current_locale !== Cot::$cfg['defaultlang'] && $featured_id > 0) {
            $rel_translation = $db->query(
                "SELECT ipage_title, ipage_desc, ipage_text
                 FROM $db_i18n_pages
                 WHERE ipage_id = ? AND ipage_locale = ?",
                [$featured_id, $current_locale]
            )->fetch(PDO::FETCH_ASSOC);

            if ($rel_translation) {
                if (!empty($rel_translation['ipage_title'])) $featured_article['page_title'] = $rel_translation['ipage_title'];
                if (!empty($rel_translation['ipage_desc'])) $featured_article['page_desc']  = $rel_translation['ipage_desc'];
                if (!empty($rel_translation['ipage_text'])) $featured_article['page_text']  = $rel_translation['ipage_text'];
            }
        }

        // Получаем название категории рекомендованной статьи (с учётом перевода)
        $featured_category_code = $featured_article['page_cat'] ?? '';
        $featured_article_category_name = '';

        if (!empty($featured_category_code)) {
            // Сначала ищем перевод категории (i18n)
            if (cot_plugin_active('i18n') && $current_locale !== Cot::$cfg['defaultlang']) {
                $cat_translation = $db->query(
                    "SELECT istructure_title FROM $db_i18n_structure
                     WHERE istructure_code = ? AND istructure_locale = ?",
                    [$featured_category_code, $current_locale]
                )->fetchColumn();

                if ($cat_translation) {
                    $featured_article_category_name = htmlspecialchars($cat_translation, ENT_QUOTES, 'UTF-8');
                }
            }

            // Если перевода нет — берём оригинал из structure
            if (empty($featured_article_category_name)) {
                $category_name_result = $db->query(
                    "SELECT structure_title FROM $db_structure WHERE structure_code = ? AND structure_area = 'page'",
                    [$featured_category_code]
                )->fetchColumn();

                $featured_article_category_name = !empty($category_name_result)
                    ? htmlspecialchars($category_name_result, ENT_QUOTES, 'UTF-8')
                    : htmlspecialchars($featured_category_code, ENT_QUOTES, 'UTF-8');
            }
        }

        // Получаем главное изображение статьи (функция плагина)
        $featured_image = get_featured_pages_market_main_first_image($featured_article['page_id'] ?? 0);

        // Формируем описание: берём desc или очищенный text, обрезаем до 160 символов
        $descriptionText = $featured_article['page_text'] ?? '';
        $page_article_text = cot_string_truncate(featuredpagesmarket_descriptionText_cleaning($descriptionText), 160, true, false);

        // Формируем URL статьи (через alias или id)
        $featured_url = (isset($featured_article['page_alias']) && !empty($featured_article['page_alias']))
            ? cot_url('page', 'c=' . $featured_article['page_cat'] . '&al=' . $featured_article['page_alias'])
            : cot_url('page', 'id=' . ($featured_article['page_id'] ?? 0));

        // Заполняем теги для строки в шаблоне
        $tt->assign([
            'FEATUREDPRO_ARTICLES_ROW_URL'             => htmlspecialchars($featured_url, ENT_QUOTES, 'UTF-8'),
            'FEATUREDPRO_ARTICLES_ROW_TITLE'           => htmlspecialchars($featured_article['page_title'] ?? '', ENT_QUOTES, 'UTF-8'),
            'FEATUREDPRO_ARTICLES_ROW_TEXT'            => htmlspecialchars($page_article_text, ENT_QUOTES, 'UTF-8'),
            'FEATUREDPRO_ARTICLES_ROW_DESC'            => htmlspecialchars(
                cot_string_truncate(strip_tags($featured_article['page_desc'] ?? ''), $desc_len, true, false),
                ENT_QUOTES,
                'UTF-8'
            ),
            'FEATUREDPRO_ARTICLES_ROW_CAT_TITLE'       => htmlspecialchars($featured_article_category_name, ENT_QUOTES, 'UTF-8'),
            'FEATUREDPRO_ARTICLES_ROW_CAT_URL'         => cot_url('page', 'c=' . $featured_article['page_cat'], '', true),
            'FEATUREDPRO_ARTICLES_ROW_LINK_MAIN_IMAGE' => htmlspecialchars($featured_image, ENT_QUOTES, 'UTF-8'),
        ]);

        // Парсим строку в шаблоне цикла статей
        $tt->parse('MAIN.FEATUREDPRO_ARTICLES_ROW');
    }

    // Парсим основной блок шаблона featuredpagesmarket.market.articles.tpl
    $tt->parse('MAIN');

    // Вставляем готовый HTML в тег шаблона market.tpl
    $t->assign('FEATUREDPRO_ARTICLES_PAGES', $tt->text('MAIN'));
} else {
    // Если статей нет — просто выходим (блок не выводится)
    return;
}