<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.delete.done
 * [END_COT_EXT]
 */
/**
 * featuredpagesmarket.market.edit.delete.done.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredpagesmarket.market.edit.delete.done.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

global $db, $db_featured_pag_mrkt, $id;

if ($id > 0)
{
    $db->delete($db_featured_pag_mrkt, "fartc_from_id = ? OR fartc_to_id = ?", [$id, $id]);
}