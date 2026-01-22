<?php
/**
 * featuredpagesmarket plug for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0 
 * Purpose: functions for the plugin featuredpagesmarket
 * Notes:
 * Filename: featuredpagesmarket.functions.php
 * @package featuredpagesmarket
 * @version 2.7.3
 * @copyright (c) webitproff 2026 https://github.com/webitproff or https://abuyfile.com/users/webitproff
 * @license BSD
 */



defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('featuredpagesmarket', 'plug');

/**
 * cleaning text !!! BETA !!! встряхиваем холст с описанием как коврик от пыли.
 * @param string $text Input text
 * @return string 
 */

function featuredpagesmarket_descriptionText_cleaning(string $text): string
{
    if (empty($text)) {
        return '';
    }
		// меняем входящее на пробелы, что бы в исходный код, текст не выходил слитно при strip_tags описания статьи или статьи 
		$tags_replace = [
			'<br>' => ' ',
			'</h1>' => ' ',
			'</h2>' => ' ',
			'</h3>' => ' ',
			'</h4>' => ' ',	
			'</li>' => ' ',			
			'<li>' => ' '
		];

		$text = strtr($text, $tags_replace);
		
    // Clean text: remove HTML, decode entities
    $text = strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));

    // Replace punctuation with spaces and normalize spaces
	$text = preg_replace('/[!?;:"\'\(\)\[\]{}<>\n\r\t]/u', ' ', $text);
    $text = preg_replace('/\s+/u', ' ', trim($text));
	
	return $text;
}



/**
 * Получает первое изображение, прикреплённое к элементу: Карточка статьи.
 *
 * @param int $page_id ID элемента (ID статьи в $db_pages)
 * @return string Полный URL к изображению или к изображению-заглушке
 */
function get_featured_pages_market_main_first_image(int $page_id): string
{
    global $db, $db_pages, $cfg;

    // Проверяем, что page_id — положительное целое число
    if ($page_id <= 0) {
        return $cfg['mainurl'] . '/plugins/featuredpagesmarket/img/image.webp';
    }

    // Определяем заглушку по умолчанию: используем конфигурацию или резервный путь
	$default_image = !empty($cfg['plugin']['featuredpagesmarket']['nonimage_page'])
		? rtrim($cfg['mainurl'], '/') . '/' . ltrim($cfg['plugin']['featuredpagesmarket']['nonimage_page'], '/')
		: rtrim($cfg['mainurl'], '/') . '/plugins/featuredpagesmarket/img/image.webp';

    // Локальный кэш для данных страницы
    static $page_cache = [];
    if (isset($page_cache[$page_id])) {
        $item = $page_cache[$page_id];
    } else {
        $item = $db->query("SELECT * FROM $db_pages WHERE page_id = ?", [$page_id])->fetch(PDO::FETCH_ASSOC);
        $page_cache[$page_id] = $item ?: [];
    }

    // Если страница не найдена, возвращаем заглушку
    if (!$item) {
        return $default_image;
    }


    // Проверяем, активен ли плагин attacher
	// если у вас плагин 'attacher' от Roffun, webitproff
    if (cot_plugin_active('attacher')) {
        global $db_attacher;
        require_once cot_incfile('attacher', 'plug');
        // Получаем первую запись с изображением из таблицы attacher
        $files_image = $db->query("SELECT * FROM $db_attacher WHERE att_area = 'page' AND att_item = ? LIMIT 1", [$page_id])->fetch(PDO::FETCH_ASSOC);
        if ($files_image) {
            // Формируем URL к изображению
            return $cfg['mainurl'] . '/' . $files_image['att_path'];
        }
    }

    // Если изображение не найдено, - возвращаем заглушку
    return $default_image;
}
