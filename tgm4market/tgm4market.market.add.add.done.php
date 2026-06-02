<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.add.add.done
 * [END_COT_EXT]
 */

/**
 * tgm4market.market.add.add.done.php - // Tag hook (we put our code on 'market.add.add.done' in the file 
 * market/inc/market.functions.php inside cot_market_add): adding our code to The Handler for completing the product addition
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.market.add.add.done.php
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

require_once cot_incfile('tgm4market', 'plug');

$item_id = (int)$id;
if (!$item_id) return;

$config = tgm4market_get_cfg();
$chat_id = trim($config['chat_id_edit']);
if (empty($chat_id)) return;

$item = Cot::$db->query(
    "SELECT * FROM " . Cot::$db->market . " WHERE fieldmrkt_id = ? AND fieldmrkt_state = 0",
    [$item_id]
)->fetch();
if (!$item) return;

$prefix = Cot::$L['m2t_new_product_prefix'] ?? '🆕 Новый товар:';
$title = $item['fieldmrkt_title'];
$url = Cot::$cfg['mainurl'] . '/' . cot_market_url($item, [], '', false);
$text = $prefix . ' ' . $title . "\n" . $url;

$message_id = tgm4market_send_message($chat_id, $text);
if ($message_id) {
    Cot::$db->insert(Cot::$db->tgm4market, [
        'item_id' => $item_id,
        'message_id' => $message_id
    ]);
}

