<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.tags
 * Tags=market.tpl:{TGM4MARKET_DISCUSSION}
 * [END_COT_EXT]
 */
/**
 * tgm4market.market.tags.php - // Tag hook (we put our code on 'market.tags' in the file 
 * market/inc/market.main.php): generates a discussion widget on the product page
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.market.tags.php
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


/* 
	
<!-- пример вставки в шаблон страницы товара -->

<!-- IF {PHP|cot_plugin_active('tgm4market')} AND {PHP.chat_id} -->
<div class="mb-3">
	<div class="card mb-4">
		<div class="card-header">
			<h4 class="h5 mb-0">{PHP.L.m2t_discussion_title}</h4>
		</div>
		<div class="card-body p-0">
			{TGM4MARKET_DISCUSSION}
		</div>
	</div>
</div>
<!-- ENDIF -->

 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('tgm4market', 'plug');
if (empty($item['fieldmrkt_id'])) return;

$item_id = (int)$item['fieldmrkt_id'];
$row = $db->query(
    "SELECT message_id FROM {$db_x}tgm4market WHERE item_id = ?",
    [$item_id]
)->fetch();
if (!$row) return;

$message_id = (int)$row['message_id'];
$config = tgm4market_get_cfg();
$chat_id = trim($config['chat_id_market']);
if (empty($chat_id)) return;

$widget = '<script async src="https://telegram.org/js/telegram-widget.js?22" '
        . 'data-telegram-discussion="' . htmlspecialchars($chat_id . '/' . $message_id) . '" '
        . 'data-comments-limit="5">'
        . '</script>';

$t->assign('TGM4MARKET_DISCUSSION', $widget);