<?php
/* ====================
[BEGIN_COT_EXT]
Code=featuredpagesmarket
Name=Featured Articles in Market PRO
Category=
Description=
Version=2.7.3
Date=Jan 22Th, 2026
Author=webitproff
Copyright=(c) webitproff 2026 | https://github.com/webitproff
Notes=
Auth_guests=R
Lock_guests=WA
Auth_members=RW
Lock_members=A
Requires_modules=market,page
Requires_plugins=
Recommends_modules=
Recommends_plugins=attacher
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
maxitems_page=1:select:0,1,2,3,5,8:3:
max_select_itemslist_page=2:select:10,50,75,100,150,200,300:100:
desc_length_page=3:select:0,50,75,100,150,200,300:100:
nonimage_page=4:string::plugins/featuredpagesmarket/img/image.webp:
[END_COT_EXT_CONFIG]
==================== */


/**
 * featuredpagesmarket.setup.php - Register data in $db_core and $db_config. Setup & Config File for the Plugin Featured Articles in Market PRO
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredpagesmarket.setup.php
 *
 * Date: Jan 22Th, 2026
 * @package featuredpagesmarket
 * @version 2.7.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

/**
Разбор полей:

    Code: Уникальный код плагина, в данном случае featuredpagesmarket.
    Name: Название плагина, например, Featured Articles in Market PRO.
    Category: Категория, к которой относится плагин.
    Description: Описание плагина, например, 
    Version: Версия плагина, например, 1.0.0.
    Date: Дата выпуска текущей версии плагина, например, 2025-02-27.
    Author: Автор плагина. Здесь можно указать ваше имя или компанию.
    Copyright: Авторские права, например, ваше имя или название вашей компании.
    Notes: Лицензия плагина. В данном случае BSD License.
    SQL: Если плагин использует SQL-таблицы, то укажите путь к SQL-скрипту. Если нет, оставьте пустым.
    Auth_guests: (Auth_guests=R) Права доступа для гостей, например, R — доступ только для чтения.
    Lock_guests: (Lock_guests=WA) Лок (лок - даже админ не поправит в админке) для гостей, например, 12345A — защищает от несанкционированного доступа.
    Auth_members: (Auth_members=RW) Права доступа для зарегистрированных пользователей, например, RW — чтение и запись.
    Lock_members: (Lock_members=A )Лок для зарегистрированных пользователей, например, 12345A.
    Recommends_modules: Модули, которые рекомендуется использовать с плагином (если применимо).
    Recommends_plugins: Плагины, которые рекомендуется использовать с плагином (если применимо).
    Requires_modules: Модули, которые необходимы для работы плагина. В данном случае, page, так как плагин работает со статьями.
    Requires_plugins: Плагины, которые необходимы для работы плагина (если применимо). Если нет, оставьте пустым.

 */
