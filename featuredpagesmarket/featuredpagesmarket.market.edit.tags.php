<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.tags
 * Tags=market.edit.tpl:{FEATUREDPRO_ARTICLES_EDIT}
 * [END_COT_EXT]
 */
/**
 * featuredpagesmarket.market.edit.tags.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredpagesmarket.market.edit.tags.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

global $cfg, $L, $db, $db_pages, $db_x; // $id,  $t

require_once cot_langfile('featuredpagesmarket', 'plug');

$max_page = (int)($cfg['plugin']['featuredpagesmarket']['maxitems_page'] ?? 5);
if ($max_page < 1) $max_page = 5;

$table_articles = $db_x . 'featured_pag_mrkt';

$featured_articles = [];
// Проверка прав администратора
if (Cot::$usr['isadmin']) {
    $featured_articles = $db->query(
        "SELECT fartc.fartc_order, fartc.fartc_to_id AS id, p.page_title AS title
         FROM $table_articles fartc
         LEFT JOIN $db_pages p ON p.page_id = fartc.fartc_to_id
         WHERE fartc.fartc_from_id = ?
         ORDER BY fartc.fartc_order ASC
         LIMIT ?",
        [$id, $max_page]
    )->fetchAll(PDO::FETCH_ASSOC);
} else {
    $featured_articles = $db->query(
        "SELECT fartc.fartc_order, fartc.fartc_to_id AS id, p.page_title AS title
         FROM $table_articles fartc
         LEFT JOIN $db_pages p ON p.page_id = fartc.fartc_to_id
         WHERE fartc.fartc_from_id = ? AND p.page_ownerid = ?
         ORDER BY fartc.fartc_order ASC
         LIMIT ?",
        [$id, Cot::$usr['id'], $max_page]
    )->fetchAll(PDO::FETCH_ASSOC);
}

// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode = 'featuredpagesmarket'; // Extentions Code
$tpl_PartExt = 'edit'; // area
$tpl_PartExtSecond = 'articles'; // location

// Загружаем шаблон для админки плагина forumspostsuser
$mskin = cot_tplfile([$tpl_ExtCode, $tpl_PartExt, $tpl_PartExtSecond], 'plug', true);

// Создаём объект шаблона XTemplate с указанным файлом шаблона в $mskin выше
// объявляем как $tt, потому что будем встраивать наш шаблон $tt в строку $t 
// $t = {FEATUREDPRO_ARTICLES_EDIT} которую вешаем на market.edit.tags и присваиваем как тег в шаблон market.edit.tpl
$tt = new XTemplate($mskin);

for ($i = 0; $i < $max_page; $i++) {
    $item = $featured_articles[$i] ?? ['id' => 0, 'title' => ''];
    $tt->assign([
        'FEATUREDPRO_ARTICLES_NUM' => $i + 1,
        'FEATUREDPRO_ARTICLES_INDEX' => $i,
        'FEATUREDPRO_ARTICLES_TO_ID' => (int)$item['id'],
        'FEATUREDPRO_ARTICLES_TO_TITLE' => htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8')
    ]);
    $tt->parse('MAIN.FEATUREDPRO_ARTICLES_ROW');
}

$tt->parse('MAIN');
$t->assign('FEATUREDPRO_ARTICLES_EDIT', $tt->text('MAIN'));



Resources::linkFileFooter(Resources::SELECT2);

// Передаём в ajax-запрос ID текущей страницы и ID текущего пользователя
$ajaxUrl = cot_url('plug', [
    'r'              => 'featuredpagesmarket',
    'ajax'           => 'search',
    'current_article_id' => $id,
    'current_user_id' => cot::$usr['id']
], '', true);

$placeholder = addslashes($L['featuredpagesmarket_selectpage'] ?? 'Select Article');

Resources::embedFooter(<<<JS
document.addEventListener('DOMContentLoaded', function () {
    $('.customrelated-select-articles').each(function () {
        if (this.dataset.inited) return;
        this.dataset.inited = true;
        const \$select = $(this);
        const \$hidden = \$select.closest('.customrelated-row').find('.customrelated-id');
        \$select.select2({
            ajax: {
                url: '{$ajaxUrl}',
                dataType: 'json',
                delay: 300,
                data: params => ({ q: params.term || '' }),
                processResults: data => ({ results: data.results || [] }),
                cache: true
            },
            minimumInputLength: 2,
            width: '100%',
            placeholder: '{$placeholder}',
            allowClear: true,
            tags: false
        });
        // Синхронизация значения при любом изменении
        const syncValue = () => {
            \$hidden.val(\$select.val() || '');
        };
        \$select.on('change', syncValue);
        \$select.on('select2:select select2:unselect', syncValue);
        // Инициализация уже выбранного значения
        const preselectedId = \$hidden.val();
        if (preselectedId && parseInt(preselectedId) > 0) {
            let text = \$select.find('option[value="' + preselectedId + '"]').text();
            if (!text) text = 'Страница #' + preselectedId;
            const option = new Option(text, preselectedId, true, true);
            \$select.append(option).trigger('change');
        }
    });
});
JS
);