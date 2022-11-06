<?php

##################################
###           ACTIONS          ###
##################################

switch($_POST['action']) {


	// date range
	case "setRange":
		App::setRange($_POST);
	break;

	case "resetRange":
		App::resetRange();
	break;


	// servers
	case "addServer":
		isAuthorized("addServer"); $status = Server::add($_POST);
	break;

	case "editServer":
		isAuthorized("editServer"); $status = Server::edit($_POST);
	break;

	case "deleteServer":
		isAuthorized("deleteServer"); $status = Server::delete($_POST['id']);
	break;

	// server alerts
	case "addServerAlert":
		isAuthorized("editServer"); $status = Server::addAlert($_POST);
	break;

	case "editServerAlert":
		isAuthorized("editServer"); $status = Server::editAlert($_POST);
	break;

	case "deleteServerAlert":
		isAuthorized("editServer"); $status = Server::deleteAlert($_POST['id']);
	break;

	case "markServerIncident":
		isAuthorized("editServer"); $status = Server::markIncident($_POST['id']);
	break;

    case "editServerIncidentComment":
		isAuthorized("editServer"); $status = Server::editComment($_POST);
	break;



	// websites
	case "addWebsite":
		isAuthorized("addWebsite"); $status = Website::add($_POST);
	break;

	case "editWebsite":
		isAuthorized("editWebsite"); $status = Website::edit($_POST);
	break;

	case "deleteWebsite":
		isAuthorized("deleteWebsite"); $status = Website::delete($_POST['id']);
	break;

	// website alerts
	case "addWebsiteAlert":
		isAuthorized("editWebsite"); $status = Website::addAlert($_POST);
	break;

	case "editWebsiteAlert":
		isAuthorized("editWebsite"); $status = Website::editAlert($_POST);
	break;

	case "deleteWebsiteAlert":
		isAuthorized("editWebsite"); $status = Website::deleteAlert($_POST['id']);
	break;

	case "markWebsiteIncident":
		isAuthorized("editWebsite"); $status = Website::markIncident($_POST['id']);
	break;

    case "editWebsiteIncidentComment":
		isAuthorized("editWebsite"); $status = Website::editComment($_POST);
	break;


	// checks
	case "addCheck":
		isAuthorized("addCheck"); $status = Check::add($_POST);
	break;

	case "editCheck":
		isAuthorized("editCheck"); $status = Check::edit($_POST);
	break;

	case "deleteCheck":
		isAuthorized("deleteCheck"); $status = Check::delete($_POST['id']);
	break;

	// check alerts
	case "addCheckAlert":
		isAuthorized("editCheck"); $status = Check::addAlert($_POST);
	break;

	case "editCheckAlert":
		isAuthorized("editCheck"); $status = Check::editAlert($_POST);
	break;

	case "deleteCheckAlert":
		isAuthorized("editCheck"); $status = Check::deleteAlert($_POST['id']);
	break;

	case "markCheckIncident":
		isAuthorized("editCheck"); $status = Check::markIncident($_POST['id']);
	break;

    case "editCheckIncidentComment":
		isAuthorized("editCheck"); $status = Check::editComment($_POST);
	break;


	// alerting - contacts
	case "addContact":
		isAuthorized("addContact"); $status = Contact::add($_POST);
	break;

	case "editContact":
		isAuthorized("editContact"); $status = Contact::edit($_POST);
	break;

	case "deleteContact":
		isAuthorized("deleteContact"); $status = Contact::delete($_POST['id']);
	break;



	// pages
	case "addPage":
		isAuthorized("addPage"); $status = Page::add($_POST);
	break;

	case "editPage":
		isAuthorized("editPage"); $status = Page::edit($_POST);
	break;

	case "deletePage":
		isAuthorized("deletePage"); $status = Page::delete($_POST['id']);
	break;





	// users
	case "addUser":
		isAuthorized("addUser"); $status = User::add($_POST);
	break;

	case "editUser":
		isAuthorized("editUser"); $status = User::edit($_POST);
	break;

	case "deleteUser":
		isAuthorized("deleteUser"); $status = User::delete($_POST['id']);
	break;


	// roles
	case "addRole":
		isAuthorized("addRole"); $status = Role::add($_POST);
	break;

	case "editRole":
		isAuthorized("editRole"); $status = Role::edit($_POST);
	break;

	case "deleteRole":
		isAuthorized("deleteRole"); $status = Role::delete($_POST['id']);
    break;


	// users
	case "addGroup":
		isAuthorized("addGroup"); $status = Group::add($_POST);
	break;

	case "editGroup":
		isAuthorized("editGroup"); $status = Group::edit($_POST);
	break;

	case "deleteGroup":
		isAuthorized("deleteGroup"); $status = Group::delete($_POST['id']);
	break;


	// files
	case "uploadFile":
		isAuthorized("uploadFile"); $status = File::upload($_POST,$_FILES);
	break;

	case "deleteFile":
		isAuthorized("deleteFile"); $status = File::delete($_POST['id']);
	break;



	// languages
	case "addLanguage":
		isAuthorized("manageSettings"); $status = Settings::addLanguage($_POST);
	break;

	case "deleteLanguage":
		isAuthorized("manageSettings"); $status = Settings::deleteLanguage($_POST['id']);
	break;



	// profile
	case "editProfile":
		$status = Profile::edit($_POST,$_FILES);
	break;


	//settings
	case "generalSettings":
		isAuthorized("manageSettings");
		Settings::update("app_name", $_POST['app_name']);
		Settings::update("app_url", rtrim($_POST['app_url'], '/') . '/');
		Settings::update("company_name", $_POST['company_name']);
		Settings::update("company_details", $_POST['company_details']);
		Settings::update("log_retention", $_POST['log_retention']);
		Settings::update("table_records", $_POST['table_records']);
		Settings::update("google_maps_api_key", $_POST['google_maps_api_key']);

		if (isset($_POST['xss_filtering'])) $xss_filtering = "true"; else $xss_filtering = "false";
		Settings::update("xss_filtering", $xss_filtering);

		$status = 40;
	break;

	case "monitoringSettings":
		isAuthorized("manageSettings");

		Settings::update("check_timeout", $_POST['check_timeout']);
		Settings::update("history_retention", $_POST['history_retention']);
		Settings::update("default_contacts", serialize($_POST['default_contacts']));

		$status = 40;
	break;

	case "localisationSettings":
		isAuthorized("manageSettings");
		Settings::update("week_start", $_POST['week_start']);
		Settings::update("default_lang", $_POST['default_lang']);
		Settings::update("timezone", $_POST['timezone']);
		Settings::update("date_format", $_POST['date_format']);
		$status = 40;
	break;

	case "emailSettings":
		isAuthorized("manageSettings");
		Settings::update("email_from_address", $_POST['email_from_address']);
		Settings::update("email_from_name", $_POST['email_from_name']);
		Settings::update("email_smtp_host", $_POST['email_smtp_host']);
		Settings::update("email_smtp_port", $_POST['email_smtp_port']);
		Settings::update("email_smtp_username", $_POST['email_smtp_username']);
		Settings::update("email_smtp_password", $_POST['email_smtp_password']);
		Settings::update("email_smtp_security", $_POST['email_smtp_security']);
		if (isset($_POST['email_smtp_auth'])) $email_smtp_auth = "true"; else $email_smtp_auth = "false";
		Settings::update("email_smtp_auth", $email_smtp_auth);
		if (isset($_POST['email_smtp_enable'])) $email_smtp_enable = "true"; else $email_smtp_enable = "false";
		Settings::update("email_smtp_enable", $email_smtp_enable);
		Settings::update("email_smtp_domain", $_POST['email_smtp_domain']);
		$status = 40;
	break;

	case "smsSettings":
		isAuthorized("manageSettings");
		Settings::update("sms_provider", $_POST['sms_provider']);
		Settings::update("sms_user", $_POST['sms_user']);
		Settings::update("sms_password", $_POST['sms_password']);
		Settings::update("sms_api_id", $_POST['sms_api_id']);
		Settings::update("sms_from", $_POST['sms_from']);
		$status = 40;
	break;

	case "twitterSettings":
		isAuthorized("manageSettings");
		Settings::update("twitter_apikey", $_POST['twitter_apikey']);
		Settings::update("twitter_apisecret", $_POST['twitter_apisecret']);
		Settings::update("twitter_token", $_POST['twitter_token']);
		Settings::update("twitter_tokensecret", $_POST['twitter_tokensecret']);
		$status = 40;
	break;

	case "pushoverSettings":
		isAuthorized("manageSettings");
		Settings::update("pushover_apitoken", $_POST['pushover_apitoken']);
		$status = 40;
	break;

	case "editNotification":
		isAuthorized("manageSettings"); $status = Settings::editNotification($_POST);
    break;

	case "telegramSettings":
		isAuthorized("manageSettings");
		Settings::updateOrCreate("telegram_bot_token", $_POST['telegram_bot_token']);
		Settings::updateOrCreate("telegram_chat_id", $_POST['telegram_chat_id']);
		$status = 40;
	break;

}


reroute($_POST,$status);

?>
