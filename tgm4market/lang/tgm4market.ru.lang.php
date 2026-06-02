<?php
/**
 * tgm4market.ru.lang.php - Russian language File
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.ru.lang.php
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

$L['info_name'] = 'Телеграм и Маркет';
$L['info_desc'] = 'Пост в Telegram-канал, официальный виджет обсуждения, обновление и удаление при редактировании товара';
$L['info_notes'] = 'Требуется PHP cURL. Настройте параметры в админке: admin.php?m=other&p=tgm4market';

$L['tgm4market_title'] = $L['info_name'];
$L['tgm4market_desc']  = $L['info_desc'];

$L['m2t_discussion_title'] = 'Обсуждение товара в Telegram';
$L['m2t_no_messages'] = 'Пока нет сообщений.';
$L['m2t_edit_action_label'] = 'Действие с постом в Telegram:';
$L['m2t_action_none'] = 'Ничего не делать';
$L['m2t_action_new'] = 'Опубликовать как новый';
$L['m2t_action_edit'] = 'Обновить существующий';
$L['m2t_new_product_prefix'] = '🆕 Новый товар:';

$L['tgm4market_admin_title'] = 'Настройки конфигурации';
$L['tgm4market_chat_id_market'] = 'Username канала (без @, для виджета)';
$L['tgm4market_chat_id_edit'] = '@Username канала (для отправки сообщений)';
$L['tgm4market_bot_token'] = 'Токен бота';
$L['tgm4market_save_success'] = 'Настройки сохранены';