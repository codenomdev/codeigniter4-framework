<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\Setting;

use CodeIgniter\Model;
use Codenom\Framework\Entities\Setting\SettingEntity;
use Codenom\Framework\Data\Setting\SettingManager;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';

    protected $returnType = SettingEntity::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['value'];
    protected $useTimestamps = false;

    // protected $beforeUpdate = ['beforeUpdate'];
    // protected $validationRules = [
    //     'code' => 'required|min_length[3]|max_length[15]',
    //     'key' => 'required|min_length[3]|max_length[50]',
    // ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // public function updateSetting($key, $post){
    //     $this->db->update($key, )
    // }
    // public function deleteZone(int $id)
    // {
    //     cache()->delete($id . '_zoneData');
    //     cache()->delete($id . '_zoneCountryCollection');
    //     return $this->db->table($this->table)->where(['id' => $id])->delete();
    // }

    // protected function beforeUpdate($data)
    // {
    //     cache()->clean();
    //     return $data;
    // }
}
