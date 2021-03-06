<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Commands;

use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\BaseCommand;

class SetupUpgrade extends BaseCommand
{
    protected $group = 'Codenom';
    protected $name = 'setup:upgrade';
    protected $description = 'Setup upgrade system add/delete your module on the system.';

    /**
     * RUN CLI
     */
    public function run($params)
    {
    }
}
