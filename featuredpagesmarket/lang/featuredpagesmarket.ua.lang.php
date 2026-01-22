<?php
/**
 * featuredpagesmarket.uk.lang.php - Ukrainian language File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredpagesmarket/lang/featuredpagesmarket.uk.lang.php
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

$L['cfg_maxitems_page'] = 'Кількість повʼязаних статей';
$L['cfg_maxitems_page_hint'] = 'Максимальна кількість публікацій, які можна призначити як "Рекомендовані статті". Відображається під час редагування товару та на його публічній сторінці.';
$L['cfg_max_select_itemslist_page'] = 'Статей у випадаючому списку';
$L['cfg_max_select_itemslist_page_hint'] = 'Кількість елементів у списку для показу під час пошуку рекомендованих статей у селекторі.';
$L['cfg_desc_length_page'] = 'Довжина тексту опису';
$L['cfg_desc_length_page_hint'] = 'Кількість символів тексту для відображення у списку рекомендованих статей.';
$L['cfg_nonimage_page'] = 'Зображення-заглушка';
$L['cfg_nonimage_page_hint'] = 'Якщо стаття не має зображення — використовується заглушка. <br>Шлях за замовчуванням <code>plugins/featuredpagesmarket/img/image.webp</code> <br>(Строго як у прикладі, без домену та слешів)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Рекомендовані статті в Market PRO';
$L['info_desc']  = 'На сторінці товару відображаються рекомендовані статті та сторінки, які призначаються під час редагування картки товару.';
$L['info_notes'] = 'Потрібен Cotonti 0.9.26 або новіший з <code>Resources::SELECT2</code>. <br>Лише для модуля Market PRO v.5+ 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Актуальна безкоштовна версія модуля інтернет-магазину та/або онлайн-маркетплейсу" class="initialism"><strong>(Безкоштовно завантажити з GitHub)</strong></abbr>
</a>';

$L['featuredpagesmarket_title'] = $L['info_name']; // рядок для адмінки
$L['featuredpagesmarket_desc']  = $L['info_desc']; // рядок для адмінки
$L['featuredpagesmarket_market_title'] = 'Рекомендовані статті до товару';

$L['featuredpagesmarket_edit_title'] = 'Рекомендовані статті до цього товару';
$L['featuredpagesmarket_add'] = 'Додати ще';
$L['featuredpagesmarket_maxreached'] = 'Досягнуто максимальну кількість рекомендованих статей';
$L['featuredpagesmarket_item_number'] = 'Рекомендована стаття до товару №';
$L['featuredpagesmarket_selectpage_hint'] = 'Почніть вводити назву статті';
$L['featuredpagesmarket_min_search'] = 'Введіть мінімум 2 символи для пошуку сторінок';
