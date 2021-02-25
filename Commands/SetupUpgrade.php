<?php

namespace Codenom\Framework\Commands;

use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\BaseCommand;
use Codenom\Framework\Code\Generator\Io;
use Codenom\Framework\Code\NameBuilders;
use Codenom\Framework\Drive\File;
use Codenom\Framework\Components\ComponentRegistrar;

class SetupUpgrade extends BaseCommand
{
    protected $group = 'Codenom';
    protected $name = 'setup:upgrade';
    protected $description = 'Setup upgrade system add/delete your module on the system.';
    const DEFAULT_APP = WRITEPATH . 'generated/app';

    public function run($params)
    {
        $this->checkDirectoryGenerated();
        $this->checkDirectoryApp();
        $this->generateAutoload();
        $this->publishAutoload();
        CLI::write('Config file was successfully generated.', 'green');
    }

    /**
     * Check folder writable & generated
     * 
     * @return string CLI::write
     */
    private function checkDirectoryGenerated()
    {
        $generator = new Io(Io::DEFAULT_DIRECTORY);
        $driver = new File();

        //check if available folder?
        if ($driver->isDirectory(WRITEPATH)) {
            //Check if given path writable is writable
            if ($driver->isWritable(WRITEPATH)) {

                //check if path generated ready?
                if (!$driver->isDirectory(WRITEPATH . 'generated')) {

                    //create path generated on path writable
                    $driver->createDirectory(WRITEPATH . 'generated');

                    return CLI::write(CLI::color('Created: folder generated successfully.', 'green'));
                }
            } else {
                CLI::error('Ops, folder writable can\'t write. Please check permission');
                exit();
            }
        } else {
            if ($driver->createDirectory(ROOTPATH . 'writable')) {
                CLI::write(CLI::color('Created: folder writable successfully.', 'green'));
            }
        }
    }

    private function checkDirectoryApp()
    {
        $driver = new File();

        if ($driver->isWritable(WRITEPATH . 'generated')) {
            if (!$driver->isDirectory(WRITEPATH . 'generated/app')) {

                if ($driver->createDirectory(WRITEPATH . 'generated/app')) {
                    CLI::write(CLI::color('Created: folder app successfully', 'green'));
                } else {
                    CLI::error('Ops, created folder app fail.');
                    exit();
                }
            }
        } else {
            if ($driver->changePermissions(WRITEPATH . 'generated', '0777')) {
                CLI::write(CLI::color('Change permission successfully', 'green'));
            } else {
                CLI::error('Change permission folder generated unsuccessfully, please change manualy.');
                exit();
            }
        }
    }

    private function publishAutoload()
    {
        $content = (new File())->fileGetContents(__DIR__ . '/../Config/Autoload.php');
        $content = str_replace('namespace Codenom\Framework\Config', 'namespace Config', $content);
        $content = str_replace('public $psr4 = [];', $this->createSchemaAutoload(), $content);

        (new File())->filePutContents(APPPATH . 'Config/Autoload.php', $content);
    }

    private function convertAutoload()
    {
        $generator = new Io();
        $content = '';
        $getGenerateAutoload = $generator->includeFile(SELF::DEFAULT_APP . '/Autoload.php');

        foreach ($getGenerateAutoload as $key => $value) {
            $namespace = (new NameBuilders())->buildClassName([$key]);
            if (array_key_exists($key, $getGenerateAutoload)) {

                if ($value === 1) {
                    $content .= "		'" . $namespace . "' => APPPATH . 'Code/" . (new NameBuilders)->buildDirectoryNameSpace($namespace) . "',\n";
                }
            }
        }

        return $content;
    }

    private function generateAutoload()
    {
        $generator = new Io(SELF::DEFAULT_APP);
        $driver = new File();
        $content = "<?php" . \PHP_EOL;
        $content .= "return [" . \PHP_EOL;
        // $content .= "	'Config' => 1,\n";

        if ($this->checkFileAutoload()) {
            $driver->deleteFile(SELF::DEFAULT_APP . '/Autoload.php');
        }

        foreach (glob(APPPATH . 'Code/*/*', GLOB_ONLYDIR) as $item) {
            $nameFile = $item . '/registration.php';
            if ($generator->fileExists($nameFile)) {
                $generator->includeFile($nameFile);
            }
        }
        $component = (new ComponentRegistrar)->getPaths(ComponentRegistrar::MODULE);

        foreach ($component as $key => $value) {
            $content .= "	'$key' => 1," . \PHP_EOL;
        }
        $content .= "];" . \PHP_EOL;

        $driver->filePutContents(SELF::DEFAULT_APP . '/Autoload.php', $content);
    }

    private function checkFileAutoload()
    {
        return (new Io(SELF::DEFAULT_APP))->fileExists('Autoload.php');
    }

    private function createSchemaAutoload()
    {
        $text = 'public $psr4 = [' . \PHP_EOL;
        $text .= "		APP_NAMESPACE => APPPATH," . \PHP_EOL;
        $text .= "		'Config' => APPPATH . 'Config'," . \PHP_EOL;
        // $text .= "'Config' => APPPATH . 'Config',\n";
        $text .= $this->convertAutoload();
        $text .= "	];" . \PHP_EOL;

        return $text;
    }
}
