# tgm4market Plugin: Integrating Your Cotonti Shop with Telegram

## Complete Guide to Installation, Setup, and Usage

**Author:** [webitproff](https://abuyfile.com/ru/users/webitproff)  

**[DEMO](https://abuyfile.com/ru/market/cotonti/plugs/plagin-tgm4market-integraciya-magazina-cotonti-s-telegram)** 

**Repository:** [https://github.com/webitproff/telegram-market-cotonti](https://github.com/webitproff/telegram-market-cotonti)

[![Version](https://img.shields.io/badge/version-4.3.1-green.svg)](https://github.com/webitproff/telegram-market-cotonti/releases)
[![Cotonti Compatibility](https://img.shields.io/badge/Cotonti-1.0-orange.svg)](https://github.com/Cotonti/Cotonti)
[![PHP](https://img.shields.io/badge/PHP-8.4-purple.svg)](https://www.php.net/releases/8_4_0.php)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue.svg)](https://www.mysql.com/)
[![Bootstrap v5.3.8](https://img.shields.io/badge/Bootstrap-v5.3.8-blueviolet.svg)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/license-BSD-blue.svg)](https://github.com/webitproff/telegram-market-cotonti/blob/main/LICENSE)
---

## Table of Contents

1. [Introduction](#introduction)
2. [Key Features](#key-features)
3. [Architecture and File Structure](#architecture-and-file-structure)
4. [Plugin Installation](#plugin-installation)
5. [Telegram Setup](#telegram-setup)
6. [Configuring the Plugin via the Cotonti Admin Panel](#configuring-the-plugin-via-the-cotonti-admin-panel)
7. [Placing Tags in Templates](#placing-tags-in-templates)
8. [How the Plugin Works: Adding, Editing, and Deleting Products](#how-the-plugin-works-adding-editing-and-deleting-products)
9. [Discussion Widget on the Product Page](#discussion-widget-on-the-product-page)
10. [Storage of Settings and Data](#storage-of-settings-and-data)
11. [Step-by-Step Usage Scenario](#step-by-step-usage-scenario)
12. [Repository and Support](#repository-and-support)
13. [Conclusion](#conclusion)

---

## Introduction

**tgm4market** is a plugin for the [Cotonti CMF](https://github.com/Cotonti/Cotonti) that fully integrates your online store (built with the **Market** module) with the Telegram messenger. It automatically publishes information about new and updated products to your Telegram channel and embeds the official Telegram Discussion widget on each product page. This allows your subscribers to instantly learn about new items, and visitors to view and leave comments (via Telegram) right from the product card.

The plugin eliminates manual posting and on‑site comment moderation: everything happens automatically, while discussions stay in the familiar Telegram environment.

---

## Key Features

- **Automatic publishing** when a new product is created: a message with the product name and a link to the website is sent to the Telegram channel.
- **Flexible control when editing** a product: you can choose whether to create a new post, update the existing one, or do nothing.
- **Official Telegram Discussion widget** is embedded into the product page using a special tag. Comments on the channel post are displayed directly on the site.
- **Link removal** when a product is deleted: the record linking the product and the Telegram message is deleted from the database (the message itself remains in the channel).
- **Independent configuration** via a convenient admin panel: the bot token and channel data are stored in a dedicated database table, not hard‑coded in the code.
- **Russian and English language support** in the plugin interface.
- **Security**: built‑in input sanitization, using `htmlspecialchars` to prevent XSS attacks.

---

## Architecture and File Structure

The plugin consists of several hook files that connect to events of the **Market** module and extend its functionality. Settings are stored in a separate database table, and the administrative interface is implemented as a tool in the “Tools” section.

The plugin folder structure (`plugins/tgm4market/`):

```
tgm4market/
├── tgm4market.setup.php          // Plugin header and registration
├── tgm4market.admin.php          // Settings page controller
├── tgm4market.admin.tpl          // Settings form template
├── tgm4market.global.php         // Global hook file (loads language strings)
├── tgm4market.market.add.add.done.php   // Handler after a product is added
├── tgm4market.market.add.tags.php       // Tags hook: adds radio buttons to the add form
├── tgm4market.market.edit.update.done.php // Handler after a product is updated
├── tgm4market.market.edit.delete.done.php // Handler after a product is deleted
├── tgm4market.market.edit.tags.php      // Tags hook: adds radio buttons to the edit form
├── tgm4market.market.tags.php           // Tags hook: generates the discussion widget on the product page
├── inc/
│   └── tgm4market.functions.php         // Core functions: send/edit messages, get configuration
├── lang/
│   ├── tgm4market.ru.lang.php           // Russian language file
│   └── tgm4market.en.lang.php           // English language file
└── setup/
    ├── tgm4market.install.sql           // SQL queries executed on installation
    └── tgm4market.uninstall.sql         // SQL queries executed on uninstallation
```

Each file handles a specific part of the logic, making maintenance and modification straightforward.

---

## Plugin Installation

1. Copy the `tgm4market` folder into the `plugins/` directory of your Cotonti site.
2. Go to the admin panel, navigate to **Extensions → Plugins**.
3. Find **tgm4market** in the list and click **Install**.
   - During installation, two database tables are automatically created:
     - `cot_tgm4market` – stores the link between a product ID and a Telegram message ID.
     - `cot_tgm4market_cfg` – stores the settings: bot token and channel usernames.
4. Once successfully installed, the plugin becomes active and you can proceed to configuration.

---

## Telegram Setup

The plugin requires three Telegram entities:

- **Bot** – will publish messages to the channel.
- **Public channel** – where the bot posts messages.
- **Comment group** – discussions happen in a separate group linked to the channel.

Brief instructions:

1. **Create a bot** via [@BotFather](https://t.me/BotFather). Send the `/newbot` command, set a name and a username ending in `bot` (e.g., `myshop_bot`). Save the obtained token – you'll need it for plugin configuration.
2. **Create a public channel**. When creating, choose “Public Channel” and set a username (e.g., `myshop`). The channel link will be `t.me/myshop`. This username will be used in two forms:
   - with `@` (`@myshop`) – for sending messages via the bot,
   - without `@` (`myshop`) – for the discussion widget.
3. **Create a comment group** (any group, can be private). Open the newly created channel, go to Settings → Discussion → Add Group, and select the group.
4. **Add the bot** to both the channel and the group as an **administrator**. In the channel, grant the “Post Messages” permission. In the group, at least “Read Messages” is sufficient.

A detailed step‑by‑step guide with screenshots (if needed) is available in the plugin documentation in the repository.

---

## Configuring the Plugin via the Cotonti Admin Panel

After installation, go to **Tools** (in the Cotonti admin panel) and select **tgm4market**. A settings page will open, reachable at:  
`admin.php?m=other&p=tgm4market`

The form contains three fields:

- **Channel username (without @, for widget)**  
  Enter the username of your public channel without the `@` symbol. Example: `myshop`.  
  This value is used to build the HTML discussion widget on the product page.

- **@Channel username (for sending messages)**  
  Enter the same username but with `@`. Example: `@myshop`.  
  This value is used when sending messages via the Telegram API (the bot will publish to this channel).

- **Bot token**  
  Paste the token obtained from @BotFather. It looks like `123456789:ABCdef...`.

Click **Save**. All data will be written to the `cot_tgm4market_cfg` table with `cfg_id = 1`. The next time you open the settings page, the values will be automatically loaded from the database.

These settings can be changed at any time. The plugin does not store them in Cotonti configuration files, making site migration safer.

---

## Placing Tags in Templates

For the plugin to work, you need to insert special tags into your theme (skin) templates. All tags are generated by the plugin automatically when the necessary settings are present.

### 1. Tag for the Add Product form

File: `skins/your_skin/market.add.tpl`  
Tag: `{TGM4MARKET_ADD_ACTION}`  

Insert it wherever convenient (e.g., before the “Save” button). It will add a block with radio buttons:

- “Do nothing”
- “Publish as new”

By default, when creating a new product, “Publish as new” is selected – the message will be sent immediately to the channel. You can switch to “Do nothing” to skip publication if needed.

### 2. Tag for the Edit Product form

File: `skins/your_skin/market.edit.tpl`  
Tag: `{TGM4MARKET_EDIT_ACTION}`  

It adds three radio buttons:

- “Do nothing”
- “Publish as new”
- “Update existing”

By default, “Do nothing” is selected to avoid accidental changes to the Telegram post. The chosen action determines the behavior when saving changes to the product (see below).

### 3. Tag for the Discussion Widget

File: `skins/your_skin/market.tpl` (the main product page template)  
Tag: `{TGM4MARKET_DISCUSSION}`  

Insert it where you want the discussion block to appear, typically after the product description or in a separate tab. The plugin will automatically load the official Telegram Discussion widget, pointing it to the correct post ID.

**Important:** All tags are processed only when the plugin is active and properly configured. If the settings are empty or the plugin is disabled, the tags will output nothing.

---

## How the Plugin Works: Adding, Editing, and Deleting Products

### Adding a Product

1. When creating a product, the admin can choose an action via the radio buttons. If “Do nothing” is selected, the plugin stops.
2. If “Publish as new” is selected (default), after the product is successfully saved the function `tgm4market_send_message()` is called. It composes the message text:
   - A prefix (e.g., “🆕 New product:”) is taken from the language file.
   - The product title is escaped for safety (`htmlspecialchars`), though the current version uses simple string interpolation; the version with `\n` and `http_build_query` is preferred for reliable line breaks.
   - An absolute link to the product page is generated.
3. The function sends a request to the Telegram Bot API using the `sendMessage` method, supplying the channel’s `@username` and the bot token from settings. Telegram returns a unique `message_id`.
4. The plugin inserts a record into the `cot_tgm4market` table with `item_id` (product ID) and `message_id`.

### Editing a Product

When editing, the admin selects one of three actions:

- **Do nothing** – the plugin performs no Telegram operations.
- **Publish as new** – a new message is sent to the channel (similar to adding), and the link is updated: if a record already existed, the `message_id` is replaced; otherwise, a new record is created.
- **Update existing** – if a record for this product exists in the table, the `editMessageText` method is called to modify the text of the previously published message. This is convenient for correcting product details without creating a new post.

### Deleting a Product

When a product is deleted (trashed or permanently), the plugin simply removes the record from `cot_tgm4market`, breaking the link. The Telegram post itself remains intact – preserving the publication history.

---

## Discussion Widget on the Product Page

The plugin uses the [official Telegram Discussion widget](https://core.telegram.org/widgets/discussion). It is embedded via the `{TGM4MARKET_DISCUSSION}` tag and displays the comment thread for a specific channel post.

Mechanism:

- When the product page is opened, the plugin looks up the `item_id` in the `cot_tgm4market` table.
- It retrieves the `message_id`.
- From the settings it takes `chat_id_market` (channel username without `@`).
- It generates HTML code like:
  ```html
  <script async src="https://telegram.org/js/telegram-widget.js?22"
          data-telegram-discussion="myshop/12345"
          data-comments-limit="5">
  </script>
  ```
- This script automatically loads and displays comments from the group linked to the channel.

Thus, visitors can see the discussion and leave comments if they open the discussion on Telegram (by clicking the “Comment” button on the site or in the messenger).

---

## Storage of Settings and Data

The plugin uses two database tables within the Cotonti installation:

### 1. `cot_tgm4market_cfg` – configuration

Structure:
- `cfg_id` – primary key (always 1, a single record).
- `chat_id_market` – channel username without `@` (for the widget).
- `chat_id_edit` – channel username with `@` (for API calls).
- `bot_token` – Telegram bot token.

Configuration data is accessed through the function `tgm4market_get_cfg()`, which executes:  
`SELECT * FROM {$db_x}tgm4market_cfg WHERE cfg_id = 1`

Every plugin file that needs settings calls this function and extracts the required field from the returned array. This means no tokens or channel names are hard‑coded – everything is loaded dynamically from the database.

### 2. `cot_tgm4market` – product‑message links

Structure:
- `item_id` (int, unique) – product identifier in the Market module.
- `message_id` (int) – Telegram message identifier.

Used to store the mapping “which product belongs to which post in the channel.” When forming the widget or updating a post, the plugin queries this table.

---

## Step-by-Step Usage Scenario

Assuming you have already installed the plugin and set up Telegram according to the instructions.

1. **Fill in the plugin settings**  
   Go to `admin.php?m=other&p=tgm4market`, enter `myshop` in the first field, `@myshop` in the second, and the bot token. Click **Save**.

2. **Add tags to templates**  
   - In `market.add.tpl`, insert `{TGM4MARKET_ADD_ACTION}`.
   - In `market.edit.tpl`, insert `{TGM4MARKET_EDIT_ACTION}`.
   - In `market.tpl`, insert `{TGM4MARKET_DISCUSSION}` where you want the discussion to appear.

3. **Create a new product**  
   Go to the add product page. A panel with action choices will appear. By default, “Publish as new” is selected. Fill in the fields and save.  
   Check your Telegram channel: a message with the product name and a link should have appeared.

4. **Open the product page on your site**  
   You will see the discussion widget. If there are no comments yet, it will display “No messages yet.” Now your subscribers can comment, and the comments will appear on the site.

5. **Edit a product**  
   When editing, a block with three options will appear. You can update the existing post or publish a new one. Select the desired action and save the changes.

6. **Delete a product**  
   When deleting a product, the link to the post is removed from the database, but the post itself remains in the channel (you can delete it manually if necessary).

---

## Repository and Support

The plugin is fully open‑source and available for download on GitHub:  
[https://github.com/webitproff/telegram-market-cotonti](https://github.com/webitproff/telegram-market-cotonti)

There you can find the latest release archive and report issues or suggest improvements through Issues. The plugin is distributed under the BSD license.

---

## Conclusion

**tgm4market** is a powerful and flexible tool for automating the interaction between your Cotonti online store and Telegram. It saves the administrator time, increases audience engagement, and makes product discussions lively and accessible directly on the site. Thanks to its thoughtful architecture and simple setup, the plugin is suitable for both small and large projects.

If you have any questions or would like to propose enhancements, please reach out via GitHub Issues. Wishing you successful sales and active discussions!
