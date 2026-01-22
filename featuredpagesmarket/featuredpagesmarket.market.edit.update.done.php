<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.update.done
 * [END_COT_EXT]
 */
/**
 * featuredpagesmarket.market.edit.update.done.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredpagesmarket.market.edit.update.done.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
 
 
defined('COT_CODE') or die('Wrong URL');

global $db, $db_pages, $db_x, $cfg; // 

// При редактировании существующей страницы используем $id (он всегда доступен после загрузки страницы)
$real_id = (int)($id > 0 ? $id : $page_id);

if ($real_id <= 0) {
    return; // Если ID всё равно 0 — не редактирование существующей страницы
}

$max_page = (int)($cfg['plugin']['featuredpagesmarket']['maxitems_page'] ?? 5);
if ($max_page < 1) $max_page = 5;

$db_featured_pag_mrkt = $db_x . 'featured_pag_mrkt';

// Удаляем старые связи
$db->delete($db_featured_pag_mrkt, "fartc_from_id = ?", [$real_id]);

$featured_articles_ids = cot_import('featured_article_id', 'P', 'ARR');

if (!is_array($featured_articles_ids) || empty($featured_articles_ids)) {
    return;
}

$used = [];
$order = 0;

foreach ($featured_articles_ids as $val) {
    $rel_id = (int) trim($val);
    if ($rel_id < 1 || $rel_id == $real_id || in_array($rel_id, $used)) {
        continue;
    }

    $exists = $db->query(
        "SELECT 1 FROM $db_pages WHERE page_id = ? AND page_state = 0",
        [$rel_id]
    )->fetchColumn();

    if (!$exists) continue;

    $db->insert($db_featured_pag_mrkt, [
        'fartc_from_id' => $real_id,
        'fartc_to_id'   => $rel_id,
        'fartc_order'   => $order++
    ]);

    $used[] = $rel_id;

    if ($order >= $max_page) break;
}