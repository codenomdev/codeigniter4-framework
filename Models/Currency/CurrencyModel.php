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

    protected $returnType = CurrencyEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'code', 'symbol_left', 'symbol_right', 'decimal_places', 'value', 'status'];
    protected $useTimestamps = true;
    protected $validationRules = [
        'code' => 'required|min_length[3]|max_length[15]',
        'key' => 'required|min_length[3]|max_length[50]',
        'value' => 'trim',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
