<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\ResourcesModel;

use Codenom\Framework\Models\Setting\SettingModel;

class SettingResource
{
    /**
     * @var \Codenom\Framework\Models\Setting\SettingModel
     */
    protected $settingModel;

    /**
     * Constructor Class
     * 
     */
    public function __construct()
    {
        $this->settingModel = model(SettingModel::class);
    }

    /**
     * Update Batch
     * @param array $value
     * 
     * @return mixed
     */
    public function updateBacth(array $data = [])
    {
        $datas = [];
        if (is_array($data['groups'])) {
            foreach ($data['groups'] as $key => $value) {
                foreach ($value['fields'] as $key => $val) {
                    $datas[] = ['key' => $key, 'value' => $val['value']];
                }
            }
        }
        cache()->clean();
        return $this->settingModel->updateBatch($datas, 'key');
    }
}
