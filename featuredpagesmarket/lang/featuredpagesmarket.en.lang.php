<?php
/**
 * featuredpagesmarket.en.lang.php - English language File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredpagesmarket/lang/featuredpagesmarket.en.lang.php
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

$L['cfg_maxitems_page'] = 'Number of related articles';
$L['cfg_maxitems_page_hint'] = 'Maximum number of publications that can be assigned as "Featured Articles". Visible when editing a product and on its public page.';
$L['cfg_max_select_itemslist_page'] = 'Articles in dropdown list';
$L['cfg_max_select_itemslist_page_hint'] = 'Number of items shown in the selector dropdown when searching for featured articles.';
$L['cfg_desc_length_page'] = 'Description text length';
$L['cfg_desc_length_page_hint'] = 'Number of characters of text to display in the list of featured articles.';
$L['cfg_nonimage_page'] = 'Fallback image';
$L['cfg_nonimage_page_hint'] = 'If an article has no image, a fallback image will be used. <br>Default path <code>plugins/featuredpagesmarket/img/image.webp</code> <br>(Strictly as shown in the example, without domain and slashes)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Featured Articles in Market PRO';
$L['info_desc']  = 'Displays featured articles and pages on the product page, manually assigned when editing the product card.';
$L['info_notes'] = 'Requires Cotonti 0.9.26 or newer with <code>Resources::SELECT2</code>. <br>Only for Market PRO module v.5+ 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Actual free version of the e-commerce and/or online marketplace module" class="initialism"><strong>(Download for free on GitHub)</strong></abbr>
</a>';

$L['featuredpagesmarket_title'] = $L['info_name']; // admin panel title
$L['featuredpagesmarket_desc']  = $L['info_desc']; // admin panel description
$L['featuredpagesmarket_market_title'] = 'Featured articles for this product';

$L['featuredpagesmarket_edit_title'] = 'Featured articles for this product';
$L['featuredpagesmarket_add'] = 'Add more';
$L['featuredpagesmarket_maxreached'] = 'Maximum number of featured articles reached';
$L['featuredpagesmarket_item_number'] = 'Featured article for product #';
$L['featuredpagesmarket_selectpage_hint'] = 'Start typing the article title';
$L['featuredpagesmarket_min_search'] = 'Enter at least 2 characters to search for pages';
