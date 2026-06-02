<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.tags
 * Tags=market.edit.tpl:{TGM4MARKET_EDIT_ACTION}
 * [END_COT_EXT]
 */
/**
 * tgm4market.market.edit.tags.php - // Tag hook (we put our code on 'market.edit.tags' in the file 
 * market.edit.php ): adding our code to the Product Edit Tamplate, adds radio buttons to the editing product form
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.market.edit.tags.php
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
	
<!-- пример вставки в шаблон страницы с формой создания нового товара -->

<!-- IF {PHP|cot_plugin_active('tgm4market')} -->
<!-- IF {PHP|cot_auth('plug', 'tgm4market', 'W')} -->
<div class="col-12">
	{TGM4MARKET_EDIT_ACTION}
</div>
<!-- ENDIF -->
<!-- ENDIF -->

 */ 
 
defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('tgm4market', 'plug');

$item_id = (int)$id;
if (!$item_id) return;

$current = cot_import('telegram_action', 'P', 'ALP') ?: 'none';

$options = [
    'none' => Cot::$L['m2t_action_none'],
    'new'  => Cot::$L['m2t_action_new'],
    'edit' => Cot::$L['m2t_action_edit'],
];

$radios = '';
foreach ($options as $val => $label) {
    $checked = ($val === $current) ? ' checked' : '';
    $radios .= '<label style="margin-right: 15px;"><input type="radio" name="telegram_action" value="' . $val . '"' . $checked . '> ' . htmlspecialchars($label) . '</label>';
}

$html = '<div class="form-group">';
$html .= '<label>' . Cot::$L['m2t_edit_action_label'] . '</label><br>';
$html .= $radios;
$html .= '</div>';

$t->assign('TGM4MARKET_EDIT_ACTION', $html);