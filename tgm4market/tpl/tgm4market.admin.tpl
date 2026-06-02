<!--
	/********************************************************************************
	* File: tgm4market.admin.tpl
	* Extension: tgm4market
	* Description: HTML template for tgm4market.admin.php.
	* Compatibility: CMF/CMS Cotonti (https://github.com/Cotonti/Cotonti)
	* Dependencies: 
	* 		 Bootstrap 5.3.+[](https://getbootstrap.com/); 
	* 		 Font Awesome Free 7.1[](https://fontawesome.com/)
	* Theme: admin 
	* Version: 4.0.2 
	* Created: 01 Jun 2026 
	* Updated: 02 Jun 2026 
	* Copyright (c) 2026 webitproff | https://github.com/webitproff
	* Source: https://github.com/webitproff/telegram-market-cotonti/tree/main
	* Demo: https://abuyfile.com/ru/market/cotonti 
	* Help and support: https://abuyfile.com/ru/forums/cotonti/custom/plugs
	* License: BSD (Free distribution with saving Copyright (c) 2026 webitproff)  
	********************************************************************************/
-->
<!-- BEGIN: MAIN -->

<div class="row justify-content-center">
    <div class="col-12 col-md-10 mx-auto">
		{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/warnings.tpl"}
		<div class="card mt-4 mb-4">
			<div class="card-header">
				<h2 class="h5 mb-0">{PHP.L.tgm4market_admin_title}</h2>
			</div>
			<div class="card-body">
				<form method="post" action="{FORM_ACTION}">
					<input type="hidden" name="action" value="save">
					<div class="form-group mb-4">
						<label>{PHP.L.tgm4market_chat_id_market}</label>
						<input type="text" class="form-control" name="chat_id_market" value="{CHAT_ID_MARKET}">
					</div>
					<div class="form-group mb-4">
						<label>{PHP.L.tgm4market_chat_id_edit}</label>
						<input type="text" class="form-control" name="chat_id_edit" value="{CHAT_ID_EDIT}">
					</div>
					<div class="form-group mb-4">
						<label>{PHP.L.tgm4market_bot_token}</label>
						<input type="text" class="form-control" name="bot_token" value="{BOT_TOKEN}">
					</div>
					<button type="submit" class="btn btn-success">{PHP.L.Save}</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END: MAIN -->