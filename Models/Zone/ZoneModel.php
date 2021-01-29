<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\Zone;

use CodeIgniter\Model;
use Codenom\Framework\Data\Country\CountryManager;
use Codenom\Framework\Entities\Zone\ZoneEntity;

class ZoneModel extends Model
{
    protected $table = 'zone';
    protected $primaryKey = 'id';

    protected $returnType = ZoneEntity::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['country_id', 'name', 'code', 'status'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'country_id' => 'required|country_list',
        'name' => 'required|min_length[3]|max_length[50]',
        'code' => 'required|iso_code_3',
        'status' => 'required|in_list[1,0]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeUpdate = ['beforeUpdate'];

    public function deleteZone(int $id)
    {
        return $this->db->table($this->table)->where(['id' => $id])->delete();
    }

    protected function beforeUpdate($data)
    {
        cache()->delete($data['id'][0] . '_zoneData');

        return $data;
    }
}
