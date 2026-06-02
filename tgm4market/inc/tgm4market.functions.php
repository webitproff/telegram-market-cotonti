<?php
	
/**
 * tgm4market.functions.php - Functions for the Plugin tgm4market
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.functions.php
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

Cot::$db->registerTable('tgm4market_cfg');
Cot::$db->registerTable('tgm4market');

require_once cot_langfile('tgm4market', 'plug');

/**
 * Получает конфигурацию плагина из БД
 */
function tgm4market_get_cfg() {
    global $db, $db_x;
    return $db->query("SELECT * FROM {$db_x}tgm4market_cfg WHERE cfg_id = 1")->fetch();
}

/**
 * Отправляет сообщение в Telegram, возвращает message_id или false
 */

function tgm4market_send_message($chat_id, $text) {
    $config = tgm4market_get_cfg();
    $bot_token = $config['bot_token'];
    if (empty($bot_token) || empty($chat_id)) {
        return 'Empty bot_token or chat_id';
    }

    $ch = curl_init("https://api.telegram.org/bot{$bot_token}/sendMessage");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'chat_id' => $chat_id,
        'text' => $text,
        'disable_web_page_preview' => false
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error = 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return $error;
    }
    curl_close($ch);
    $result = json_decode($response, true);
    if (!$result['ok']) {
        return 'Telegram API error: ' . ($result['description'] ?? 'unknown') . ' (code ' . ($result['error_code'] ?? '0') . ')';
    }
    return $result['result']['message_id'] ?? false;
}


/**
 * Редактирует существующее сообщение в Telegram
 */
function tgm4market_edit_message($chat_id, $message_id, $text) {
    $config = tgm4market_get_cfg();
    $bot_token = $config['bot_token'];
    if (empty($bot_token) || empty($chat_id) || empty($message_id)) return false;

    $ch = curl_init("https://api.telegram.org/bot{$bot_token}/editMessageText");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => $text,
        'disable_web_page_preview' => false
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    return isset($result['ok']) && $result['ok'] === true;
}