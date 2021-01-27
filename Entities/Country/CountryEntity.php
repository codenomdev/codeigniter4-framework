<?php

namespace Codenom\Framework\Entities\Country;

use CodeIgniter\Entity;

class CountryEntity extends Entity
{
    /**
     * Maps names used in sets and gets against unique
     * names within the class, allowing independence from
     * database column names.
     *
     * Example:
     *  $datamap = [
     *      'db_name' => 'class_name'
     *  ];
     */
    protected $datamap = [];

    /**
     * Define properties that are automatically converted to Time instances.
     */
    protected $dates = [];

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     */
    protected $casts = [];

    /**
     * Per-user permissions cache
     * @var array
     */
    protected $permissions = [];

    /**
     * Per-user roles cache
     * @var array
     */
    protected $roles = [];
}
