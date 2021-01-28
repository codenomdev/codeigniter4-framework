<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Data\ObjectManager;

interface ObjectManagerInterface
{
    /**
     * Create where database
     *
     * @param array $data
     * @return mixed
     */
    public function where(array $data);

    /**
     * Create join database
     * 
     * @param string $table of name table
     * @param string $cond of condition field
     * @param string $type INNER JOIN|RIGHT JOIN|CROSS JOIN|OUTER JOIN|STRAIGHT JOIN
     * @return mixed
     */
    public function join($table, $cond, $type = '');

    /**
     * Create select field data
     * 
     * @param string $fields example: 'id, name, ...etc field'
     * @return mixed
     */
    public function select(string $fields);

    /**
     * Load data
     * 
     * @var $this->db->get()
     * @return mixed
     */
    public function load();

    /**
     * Create ordering data
     * 
     * @var ASC|DESC type data
     * @param string|array $order example: 'id', 'ASC|DESC' or ['id', 'ASC|DESC']
     * @return mixed
     */
    public function ordering($order);

    /**
     * Create limiting result data
     * 
     * @param int $limit example: 10, 20, or etc.
     * @return mixed
     */
    public function limiting($limit);

    /**
     * Create set aliases name of field
     * 
     * @param string $fields
     * @return bool
     */
    public function setAliases($fields): bool;
}
