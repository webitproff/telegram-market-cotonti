<?php
/**
 * tgm4market.en.lang.php - English language File
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.en.lang.php
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

$L['info_name'] = 'Telegram and Market';
$L['info_desc'] = 'Post to Telegram channel, official discussion widget, update and delete on product edit';
$L['info_notes'] = 'Requires PHP cURL. Configure settings in admin: admin.php?m=other&p=tgm4market';

$L['tgm4market_title'] = $L['info_name'];
$L['tgm4market_desc']  = $L['info_desc'];

$L['m2t_discussion_title'] = 'Product Discussion in Telegram';
$L['m2t_no_messages'] = 'No messages yet.';
$L['m2t_edit_action_label'] = 'Telegram post action:';
$L['m2t_action_none'] = 'Do nothing';
$L['m2t_action_new'] = 'Publish as new';
$L['m2t_action_edit'] = 'Update existing';
$L['m2t_new_product_prefix'] = '🆕 New product:';

$L['tgm4market_admin_title'] = 'Configuration Settings';
$L['tgm4market_chat_id_market'] = 'Channel username (without @, for widget)';
$L['tgm4market_chat_id_edit'] = '@Channel username (for sending messages)';
$L['tgm4market_bot_token'] = 'Bot token';
$L['tgm4market_save_success'] = 'Settings saved';