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
    protected $settingManager;

    public function __construct()
    {
        $this->settingManager = new SettingManager();
        helper(['admin', 'status']);
    }

    public function settingCollection()
    {
        // $data = [];
        // $data[] = $this->allowRegistration();
        // $data[] = $this->allowRemembering();
        $attribute = [];
        $setting = $this->settingManager->getGroupSettingByScope();
        foreach ($setting as $key => $value) {
            $get = $this->settingManager->getSetting()->getByScope($value->scope);
            $attribute[$key] = $this->attributesInput($value->scope, $get);
        }
        // $attribute = $this->attributesInput('config', $setting);
        return $attribute;
    }

    /**
     * Get dropdown allow registration
     * 
     * @return string
     */
    // public function allowRegistration()
    // {
    //     $get = $this->settingManager->getSetting()->getByKey('allow_registration');
    //     $attribute = $this->attributesInput($get->setting_key);
    //     $dropdown = add_field_dropdown($attribute['name'], get_status(), set_value($attribute['name'], $get->setting_value), $attribute);
    //     return $dropdown;
    // }

    // /**
    //  * Allow Remembering
    //  * 
    //  * @return string
    //  */
    // public function allowRemembering()
    // {
    //     $get = $this->settingManager->getSetting()->getByKey('allow_remembering');
    //     $attribute = $this->attributesInput($get->setting_key);
    //     $dropdown = add_field_dropdown($attribute['name'], get_status(), set_value($attribute['name'], $get->setting_value), $attribute);
    //     return $dropdown;
    // }

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
            $names = $key . '[' . $settingKey . ']';
            $label = lang('Setting.label.' . $settingKey);
            $attId = ucfirst($settingKey);
            $value = $value->setting_value;
            $result['content'][$keys] = [
                'key' => $settingKey,
                'name' => $names,
                'label' => $label,
                'id' => $attId,
                'value' => $value,
            ];
        }

        return $result;
    }
}
