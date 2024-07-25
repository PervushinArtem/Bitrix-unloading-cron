<?php
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/../../../..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define("BX_CRONTAB", true);
define('BX_WITH_ON_AFTER_EPILOG', true);
define('BX_NO_ACCELERATOR_RESET', true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/**
* Это проверка для площадок разработчиков. На бою она всегда запускает агенты. На площадках разработчиков только на время работы разраба
* This is a check for developer sites. During battle, she always launches agents. At developer sites only for the duration of the developer’s work
*/
if (ControlCron::startupCheck()) {
    @set_time_limit(0);
    @ignore_user_abort(true);

    CEvent::CheckEvents();

    if (CModule::IncludeModule('sender')) {
        \Bitrix\Sender\MailingManager::checkPeriod(false);
        \Bitrix\Sender\MailingManager::checkSend();
    }

    require($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/tools/backup.php");

    CMain::FinalActions();
}
