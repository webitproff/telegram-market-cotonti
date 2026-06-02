<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.update.done
 * [END_COT_EXT]
 */
/**
 * tgm4market.market.edit.update.done.php - // Tag hook (we put our code on 'market.edit.update.done' in the file 
 * market/inc/market.functions.php inside cot_market_update): adding our code to the Product Update Completion Handler
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.market.edit.update.done.php
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

$action = cot_import('telegram_action', 'P', 'ALP') ?: 'none';
if ($action === 'none') return;

$config = tgm4market_get_cfg();
$chat_id = trim($config['chat_id_edit']);
if (empty($chat_id)) return;

$item = $db->query(
    "SELECT * FROM $db_market WHERE fieldmrkt_id = ? AND fieldmrkt_state = 0",
    [$item_id]
)->fetch();
if (!$item) return;

$prefix = Cot::$L['m2t_new_product_prefix'] ?? '🆕 Новый товар:';
$title = $item['fieldmrkt_title'];
$url = $cfg['mainurl'] . '/' . cot_market_url($item, [], '', false);
$text = $prefix . ' ' . $title . "\n" . $url;

$existing = $db->query(
    "SELECT message_id FROM {$db_x}tgm4market WHERE item_id = ?",
    [$item_id]
)->fetch();

if ($action === 'new') {
    $new_message_id = tgm4market_send_message($chat_id, $text);
    if ($new_message_id) {
        if ($existing) {
            $db->update($db_x . 'tgm4market', ['message_id' => $new_message_id], "item_id = ?", [$item_id]);
        } else {
            $db->insert($db_x . 'tgm4market', ['item_id' => $item_id, 'message_id' => $new_message_id]);
        }
    }
} elseif ($action === 'edit' && $existing) {
    tgm4market_edit_message($chat_id, $existing['message_id'], $text);
}