<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\Country;

use CodeIgniter\Model;
use Codenom\Framework\Entities\Country\CountryEntity as Country;

class CountryModel extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'id';

    protected $return = Country::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'iso_code_2', 'iso_code_3', 'status'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[25]',
        'iso_code_2' => 'required|iso_code_2',
        'iso_code_3' => 'required|iso_code_3',
        'status' => 'required|in_list[0,1]'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeUpdate = ['beforeUpdate'];
    protected $beforeInsert = ['beforeInsert'];

    public function deleteCountry(int $id)
    {
        cache()->delete('_countryCollection');
        cache()->delete($id . '_countryData');
        return $this->db->table('country')->where('id', $id)->delete();
    }

    protected function beforeInsert($data)
    {
        cache()->delete('_countryCollection');
        return $data;
    }

    protected function beforeUpdate($data)
    {
        cache()->delete('_countryCollection');
        cache()->delete($data['id'][0] . '_countryData');

        return $data;
    }
}
