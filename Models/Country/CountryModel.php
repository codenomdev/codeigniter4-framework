<?php

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

    public function deleteCountry(int $id)
    {
        return $this->db->table('country')->where('id', $id)->delete();
    }
}
