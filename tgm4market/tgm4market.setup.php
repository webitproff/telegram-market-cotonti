<?php
/**
 * [BEGIN_COT_EXT]
 * Code=tgm4market
 * Name=tgm4market
 * Description=Пост в Telegram-канал, официальный виджет обсуждения, обновление и удаление при редактировании товара
 * Version=4.1.3
 * Date=2026-06-02
 * Author=webitproff
 * Copyright=&copy; webitproff 2026 https://github.com/webitproff
 * Notes=Требуется PHP cURL. Настройте параметры в админке: admin.php?m=other&p=tgm4market
 * Auth_guests=R
 * Lock_guests=W12345A
 * Auth_members=RW
 * Lock_members=
 * [END_COT_EXT]
 */

defined('COT_CODE') or die('Wrong URL');




/**
 * tgm4market.setup.php - Register data in $db_core and $db_config. Setup & Config File for the Plugin tgm4market
 *
 * tgm4market plugin for CMF Cotonti (latest for today), PHP 8.4+, MySQL 8.0+
 * Date: Jun 2Th, 2026
 * Filename: tgm4market.setup.php
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
/**
Разбор полей:

    Code: Уникальный код плагина, в данном случае featuredproducts.
    Name: Название плагина, например, Featured Products in Market.
    Category: Категория, к которой относится плагин.
    Description: Описание плагина, например, 
    Version: Версия плагина, например, 1.0.0.
    Date: Дата выпуска текущей версии плагина, например, 2025-02-27.
    Author: Автор плагина. Здесь можно указать ваше имя или компанию.
    Copyright: Авторские права, например, ваше имя или название вашей компании.
    Notes: Лицензия плагина. В данном случае BSD License.
    SQL: Если плагин использует SQL-таблицы, то укажите путь к SQL-скрипту. Если нет, оставьте пустым.
    Auth_guests: (Auth_guests=R) Права доступа для гостей, например, R — доступ только для чтения.
    Lock_guests: (Lock_guests=WA) Лок (лок - даже админ не поправит в админке) для гостей, например, 12345A — защищает от несанкционированного доступа.
    Auth_members: (Auth_members=RW) Права доступа для зарегистрированных пользователей, например, RW — чтение и запись.
    Lock_members: (Lock_members=A )Лок для зарегистрированных пользователей, например, 12345A.
    Recommends_modules: Модули, которые рекомендуется использовать с плагином (если применимо).
    Recommends_plugins: Плагины, которые рекомендуется использовать с плагином (если применимо).
    Requires_modules: Модули, которые необходимы для работы плагина. В данном случае, page, так как плагин работает со статьями.
    Requires_plugins: Плагины, которые необходимы для работы плагина (если применимо). Если нет, оставьте пустым.

 */ 
/* 
**Структура файлов плагина (текущая версия):**
```
tgm4market/
├── tgm4market.setup.php          // Заголовок плагина и регистрация
├── tgm4market.admin.php          // Контроллер страницы настроек
├── tgm4market.admin.tpl          // Шаблон формы настроек
├── tgm4market.global.php         // Файл глобального хука (подключает язык)
├── tgm4market.market.add.add.done.php   // Обработчик завершения добавления товара
├── tgm4market.market.add.tags.php       // Хук тегов: добавляет радиокнопки в форму добавления
├── tgm4market.market.edit.update.done.php // Обработчик завершения обновления товара
├── tgm4market.market.edit.delete.done.php // Обработчик удаления товара
├── tgm4market.market.edit.tags.php      // Хук тегов: добавляет радиокнопки в форму редактирования
├── tgm4market.market.tags.php           // Хук тегов: генерирует виджет обсуждения на странице товара
├── inc/
│   └── tgm4market.functions.php         // Основные функции: отправка/редактирование сообщений, получение конфигурации
├── lang/
│   ├── tgm4market.ru.lang.php           // Русский языковой файл
│   └── tgm4market.en.lang.php           // Английский языковой файл
└── setup/
    ├── tgm4market.install.sql           // SQL-запросы при установке
    └── tgm4market.uninstall.sql         // SQL-запросы при удалении
```

 */
 