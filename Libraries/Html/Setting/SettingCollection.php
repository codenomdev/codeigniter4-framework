<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Libraries\Html\Setting;

use Codenom\Framework\Data\Setting\SettingManager;

class SettingCollection
{

    /**
     * @var Codenom\Framework\Data\Setting\SettingManager
     */
    protected $settingManager;

    public function __construct()
    {
        $this->settingManager = new SettingManager();
        helper(['admin', 'status']);
    }

    public function settingCollection()
    {
        $attribute = [];
        $setting = $this->settingManager->getGroupSettingByScope();
        foreach ($setting as $key => $value) {
            $get = $this->settingManager->getSetting()->getByScope($value->scope);
            $attribute[$key] = $this->attributesInput($value->scope, $get);
        }
        return $attribute;
    }

    /**
     * Set a attribute form input
     * 
     * @param string $name for index name input.
     * @return array
     */

    public function attributesInput(string $key, $param)
    {
        $result['meta'] = lang('Setting.title.' . $key);
        foreach ($param as $keys => $value) {
            $settingKey = $value->setting_key;
            $settingScope = $value->setting_scope;
            $names =  'groups[' . $key . '][fields][' . $settingKey . '][value]';
            $label = lang('Setting.label.' . $settingKey);
            $attId = ucfirst($settingKey);
            $value = $value->setting_value;
            $result['content'][$keys] = [
                'key' => $settingKey,
                'name' => $names,
                'label' => $label,
                'id' => $attId,
                'value' => $value,
                'validation' => $settingScope . '.' . $settingKey,
            ];
        }

        return $result;
    }
}
