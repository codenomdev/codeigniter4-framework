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
use Codenom\Framework\CLI\Component\Command;

class SetupCompile extends BaseCommand
{
    protected $group = 'Codenom';
    protected $name = 'setup:compile';
    protected $description = 'Setup Compile system after modify, add, delete module on the system.';

    /**
     * Run Command\'s
     */
    public function run($params)
    {
        new Command();
        CLI::write('Compiled system finish.', 'green');
    }
}
