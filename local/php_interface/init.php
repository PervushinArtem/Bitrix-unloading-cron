<?php

/**
 * Регистрация события проверки работы на сайте
 * Registering a performance check event on the site
 */
AddEventHandler('main', 'OnAfterEpilog', ['ControlCron', 'setTimeLog']);

/**
 * Класс для контроля запуска крона на тестовых площадках
 * Крон на тестовых работает только пока разраб ходит по сайту и не более 30 мин после того как перестал ходить
 * После 10 мин хождения по сайту временная метка обновляется
 * Class for controlling the launch of cron on test sites
 * Cron on test runs only while the developer is walking around the site and no more than 30 minutes after he stops walking
 * After 10 minutes of walking around the site, the timestamp is updated
 */
class ControlCron
{
    private const FILE_LOG = __DIR__ . '/ControlCron.log'; //Путь до контрольного лога. Path to the control log
    private const WORUNG_TIME = 1800; //Время запуска крона после хождения по сайту. Time to start the cron after walking around the site. (seconds)
    private const TIME = 600; //Интервал обновления временной метки. Timestamp update interval (seconds)

    /**
     * Запись временной метки
     * Recording a timestamp
     *
     * @return void
     */
    public static function setTimeLog(): void
    {
        if (self::control()) {
            $time = self::getTimeLog();
            $currentTime = time();
            $lag = $currentTime - $time;
            if ($lag > self::TIME) {
                file_put_contents(self::FILE_LOG, $currentTime);
            }
        }
    }

    /**
     * Проверка можно ли запускать крон
     * Checking whether cron can be started
     *
     * @return bool
     */
    public static function startupCheck(): bool
    {
        if (!self::control()) {
            return true;
        }
        $time = self::getTimeLog();
        $lag = time() - $time;
        if ($lag < self::WORUNG_TIME) {
            return true;
        }
        return false;
    }

    /**
     * Чтение временной метки
     * Reading timestamp
     *
     * @return int
     */
    private static function getTimeLog(): int
    {
        $time = 0;
        if (file_exists(self::FILE_LOG)) {
            $time = file_get_contents(self::FILE_LOG);
        }
        return $time;
    }

    /**
     * Контроль запуска
     * Launch control
     *
     * @return bool
     */
    private static function control(): bool
    {
        if (\Bitrix\Main\Loader::includeModule('main')) {
            $noProd = \COption::GetOptionString('main', 'update_devsrv', '');
            if ($noProd === 'Y') {
                return true;
            }
        }
        return false;
    }
}
