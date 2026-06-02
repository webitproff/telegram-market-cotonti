<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=tools
 * [END_COT_EXT]
 */
 
/**
 * tgm4market.admin.php - Configuration Settings Plugin tgm4market and save to `cot_tgm4market_cfg`
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.admin.php
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
require_once cot_langfile('tgm4market', 'plug');

$action = cot_import('action', 'P', 'ALP');

// Сохранение настроек
if ($action === 'save') {
    $chat_id_market = cot_import('chat_id_market', 'P', 'TXT');
    $chat_id_edit   = cot_import('chat_id_edit', 'P', 'TXT');
    $bot_token      = cot_import('bot_token', 'P', 'TXT');

    $db->update($db_x . 'tgm4market_cfg', [
        'chat_id_market' => $chat_id_market,
        'chat_id_edit'   => $chat_id_edit,
        'bot_token'      => $bot_token,
    ], 'cfg_id = 1');

    cot_message(Cot::$L['tgm4market_save_success']);
    cot_redirect(cot_url('admin', 'm=other&p=tgm4market', '', true));
    exit;
}

// Получение текущих значений
$config = $db->query("SELECT * FROM {$db_x}tgm4market_cfg WHERE cfg_id = 1")->fetch();

$t = new XTemplate(cot_tplfile('tgm4market.admin', 'plug'));
cot_display_messages($t);

$t->assign([
    'FORM_ACTION' => cot_url('admin', 'm=other&p=tgm4market', '', true),
    'CHAT_ID_MARKET' => htmlspecialchars($config['chat_id_market'] ?? ''),
    'CHAT_ID_EDIT'   => htmlspecialchars($config['chat_id_edit'] ?? ''),
    'BOT_TOKEN'      => htmlspecialchars($config['bot_token'] ?? ''),
]);
// В админке мы сами рулим данными, и угроза минимальна если не использовать htmlspecialchars, 
// но плагин будет использоваться разными людьми, поэтому безопаснее экранировать все строки, попадающие в HTML.

$t->parse('MAIN');
$pluginBody = $t->text('MAIN');