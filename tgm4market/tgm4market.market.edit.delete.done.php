<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.delete
 * [END_COT_EXT]
 */
/**
 * tgm4market.market.edit.delete.php - // Tag hook (we put our code on 'market.delete.done' in the file 
 * /public_html/modules/market/inc/MarketControlService.php ): adding our code to the Product Deletion Handler
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.market.edit.delete.php
 *
 * Source: https://github.com/webitproff/telegram-market-cotonti/
 * Demo: https://abuyfile.com/ru/market/cotonti 
 *
 * @package tgm4market
 * @version 4.1.3
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

$item_id = (int)$id;
if ($item_id > 0) {
    $db->delete($db_x . 'tgm4market', "item_id = ?", [$item_id]);
}