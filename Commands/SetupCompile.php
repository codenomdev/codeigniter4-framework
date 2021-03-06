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
    protected $description = 'Setup upgrade system add/delete your module on the system.';

    /**
     * Run Command\'s
     */
    public function run($params)
    {
        new Command();
        CLI::write('Compiled system is successfully.', 'green');
        // $this->template-=
        // CLI::write('Check folder permission', 'dark_gray');
        // if (!\is_null($this->generate->checkPermissionWritableDirectory())) {
        //     $this->generate->removeGenerateAutoload();
        //     $createSchema = $this->template->contentAutoloadGenerate($this->generate->getNameModule());
        //     if ($this->generate->fileCreate($createSchema)) {
        //         CLI::newLine();
        //     } else {
        //         CLI::error('Ops, compiled not successfully, please contact http://codenom.com/contact');
        //     }
        // } else {
        //     CLI::error('Ops, Can\'t create directory');
        // }
    }
}
