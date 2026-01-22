<?php
/**
 * featuredpagesmarket.ru.lang.php - Russian language File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredpagesmarket/lang/featuredpagesmarket.ru.lang.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');



/**
 * Plugin Config
 */

$L['cfg_maxitems_page'] = 'Количество связанных статей';
$L['cfg_maxitems_page_hint'] = 'Максимальное число публикаций, которые можно установить как "Рекомендуемые статьи". Визуально видим при редактировании товара и на его публичной странице.';
$L['cfg_max_select_itemslist_page'] = 'Статей в выпадающем списке';
$L['cfg_max_select_itemslist_page_hint'] = 'Количество элементов в списке для показа при поиске рекомендуемых статей в селекторе.';
$L['cfg_desc_length_page'] = 'Длина текста описания';
$L['cfg_desc_length_page_hint'] = 'Количество символов текста для показа в списках рекомендуемых товаров.';
$L['cfg_nonimage_page'] = 'Картинка-заглушка';
$L['cfg_nonimage_page_hint'] = 'Если статья без картинки - устанавливаем заглушку. <br>Путь по-умолчанию <code>plugins/featuredpagesmarket/img/image.webp</code> <br>(Строго как в примере, без домена и слешей)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Рекомендуемые Статьи в Market PRO';
$L['info_desc']  = 'На странице товара, показываем рекомендуемые статьи и страницы, которые назначаем, при редактировании карточки этого товара.';
$L['info_notes'] = 'Минимум Cotonti 0.9.26 уже с <code>Resources::SELECT2</code>. <br>Только для модуля Market PRO v.5+ 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Актуальная бесплатная версия модуля интернет-магазина и/или онлайн-рынка" class="initialism"><strong>(Скачать бесплатно с GitHub)</strong></abbr>
</a>';

$L['featuredpagesmarket_title'] = $L['info_name']; // строка для админки
$L['featuredpagesmarket_desc']  = $L['info_desc']; // строка для админки
$L['featuredpagesmarket_market_title'] = 'Рекомендуемые статьи к товару';

$L['featuredpagesmarket_edit_title'] = 'Рекомендуемые статьи к этому товару';
$L['featuredpagesmarket_add'] = 'Добавить ещё';
$L['featuredpagesmarket_maxreached'] = 'Достигнут максимум рекомендуемых статей';
$L['featuredpagesmarket_item_number'] = 'Рекомендуемая статья к товару №'; 
$L['featuredpagesmarket_selectpage_hint'] = 'Начните вводить название статьи'; 
$L['featuredpagesmarket_min_search'] = 'Введите минимум 2 символа для поиска страниц'; 