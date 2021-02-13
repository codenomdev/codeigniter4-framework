<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\I18n;

use DateTimeZone;
use Codenom\Framework\Data\Setting\SettingManager;
use CodeIgniter\I18n\Time;

class DateManager
{
    /**
     * @var Codenom\Framework\Data\Setting\SettingManager
     */
    protected $settingManager;

    /**
     * Constructor Class
     * 
     * @param Codenom\Framework\Data\Setting\SettingManager
     */
    public function __construct()
    {
        $this->settingManager = new SettingManager();
    }

    public function getLocale()
    {
        $datetime = $this->settingManager->getSetting()->getByKey('datetime_default');
        return new Time('now', $datetime->setting_value);
    }

    /**
     * Get Date Time Collection
     * 
     * @param integer $what    One of the DateTimeZone class constants (for listIdentifiers)
     * @param string  $country A two-letter ISO 3166-1 compatible country code (for listIdentifiers)
     * 
     * @return array
     */
    public function getDateTime(int $what = DateTimeZone::ALL, string $country = null)
    {
        $timezone = DateTimeZone::listIdentifiers($what, $country);

        return $timezone;
    }
}
