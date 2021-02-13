<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Html\I18n;

use Codenom\Framework\Data\Setting\SettingManager;
use Codenom\Framework\Data\I18n\DateManager;

class DataCollection
{
    /**
     * @var Codenom\Framework\Data\Setting\SettingManager
     */
    protected $settingManager;

    /**
     * @var Codenom\Framework\Data\I18n\DateManager;
     */
    protected $dateManager;

    public function __construct()
    {
        $this->settingManager = new SettingManager();
        $this->dateManager = new DateManager();
        helper(['date']);
    }

    public function timeZoneCollection()
    {
        $result = [];
        foreach ($this->dateManager->getDateTime() as $timezone) {
            $result[$timezone] = $timezone;
        }

        return $result;
        // $dateTime = $this->settingManager->getSetting()->getByKey('datetime_default');
        // if (is_null($default)) {
        //     $default = $dateTime->setting_value;
        // }
        // return timezone_select('form-control', $default);
    }
}
