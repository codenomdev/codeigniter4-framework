<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Models\Currency;

use CodeIgniter\Model;
use Codenom\Framework\Entities\Currency\CurrencyEntity;

class CurrencyModel extends Model
{
    protected $table = 'currency';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = CurrencyEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'code', 'symbol_left', 'symbol_right', 'decimal_places', 'value', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'title' => [
            'label' => 'Currency.form.label.titleCurrency',
            'rules' => 'required|min_length[3]|max_length[32]',
        ],
        'code' => [
            'label' => 'Currency.form.label.codeCurrency',
            'rules' => 'required|iso_code_3',
        ],
        // 'symbol_left' => [
        //     'label' => 'Currency.form.label.symbolLeftCurrency',
        // ],
        // 'symbol_right' => [
        //     'label' => 'Currency.form.label.symbolRightCurrency',
        // ],
        // 'decimal_places' => [
        //     'label' => 'Currency.form.label.decimalPlaces',
        // ],
        // 'value' => [
        //     'label' => 'Currency.form.label.value',
        // ],
        'status' => [
            'label' => 'Currency.form.label.status',
            'rules' => 'required|in_list[1,0]'
        ]
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeUpdate = ['beforeUpdate'];
    protected $beforeInsert = ['beforeInsert'];

    protected function beforeUpdate(array $data)
    {
        cache()->delete($data['id'][0] . '_currencyById');
        cache()->delete('currencyCollection');

        return $data;
    }

    // public function deleteCurrencyById($id)
    // {
    //     cache()->delete($id . '_currencyById');
    //     cache()->delete('currencyCollection');
    //     return $this->db->table($this->table)->where(['id' => $id])->purgeDeleted();
    // }

    protected function beforeInsert(array $data)
    {
        if ($data['data']['code']) {
            $data['data']['code'] = \strtoupper($data['data']['code']);
        }
        cache()->delete('currencyCollection');

        return $data;
    }
}
