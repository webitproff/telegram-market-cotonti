-- tgm4market.install.sql
--
-- ЗАПРОС СОЗДАНИЕ ТАБЛИЦ В БД ДЛЯ ПЛАГИНА
--
-- tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
-- Date: Jun 2Th, 2026
-- Filename: tgm4market.install.sql
--
-- Source: https://github.com/webitproff/telegram-market-cotonti/
-- Demo: https://abuyfile.com/ru/market/cotonti 
-- 
-- package tgm4market
-- version 4.1.3
-- author webitproff
-- copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
-- license BSD
-- 

CREATE TABLE IF NOT EXISTS `cot_tgm4market` (
  `item_id` int UNSIGNED NOT NULL,
  `message_id` int NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cot_tgm4market_cfg` (
  `cfg_id` int unsigned NOT NULL AUTO_INCREMENT,
  `chat_id_market` varchar(255) NOT NULL DEFAULT '',
  `chat_id_edit` varchar(255) NOT NULL DEFAULT '',
  `bot_token` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cfg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cot_tgm4market_cfg` (`cfg_id`, `chat_id_market`, `chat_id_edit`, `bot_token`)
VALUES (1, '', '', '')
ON DUPLICATE KEY UPDATE `cfg_id` = 1;