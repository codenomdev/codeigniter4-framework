<?php

namespace Codenom\Framework\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Codenom\Framework\Exception\Commands\TemplateController;
use Codenom\Framework\Exception\Commands\TemplateConfig;

/**
 * Create an Module in HMVC
 *
 * @package App\Commands
 * @author Mufid Jamaluddin <https://github.com/MufidJamaluddin/Codeigniter4-HMVC>
 */
class ModuleCreate extends BaseCommand
{
    /**
     * The group the command is lumped under
     * when listing commands.
     *
     * @var string
     */
    protected $group       = 'Development';

    /**
     * The Command's name
     *
     * @var string
     */
    protected $name        = 'create:module';

    /**
     * the Command's short description
     *
     * @var string
     */
    protected $description = 'Create CodeIgniter Modules in app/Modules/(company/author name)/module folder';

    /**
     * the Command's usage
     *
     * @var string
     */
    protected $usage        = 'create:module [ModuleName] [Options]';

    /**
     * the Command's Arguments
     *
     * @var array
     */
    // protected $arguments    = ['ModuleName' => 'Module name to be created'];

    /**
     * the Command's Options
     *
     * @var array
     */
    protected $options      = [
        '-f' => 'Set Company/Author name of module',
        '-s' => 'Set name of module frontend, or backend. (default frontend)',
    ];

    /**
     * Private or Protected Property
     */
    // protected $string = 'Module: ';

    /**
     * Module Name to be Created
     */
    protected $module_name;

    /**
     * Module Set to be Created
     */
    protected $module_set;


    /**
     * Module folder (default /Modules)
     */
    protected $module_folder;


    /**
     * View folder (default /View)
     */
    protected $view_folder;


    /**
     * Run route:update CLI
     */
    public function run(array $params)
    {
        helper('inflector');


        $moduleFolder = $params['-f'] ?? CLI::getOption('f');
        $moduleSetFolder = $params['-s'] ?? CLI::getOption('s');
        // $this->module_set = $moduleSetFolder;
        $this->module_set = \ucfirst($moduleSetFolder);

        if (!isset($moduleFolder) || empty($moduleFolder) || $moduleFolder == 1) {
            CLI::error($this->options['-f'] . ' must be set!', 'red');
            CLI::newLine();
            CLI::write("Please run 'php spark help create:module' for view all settings.", 'dark_gray');
            return;
        }

        if (!isset($moduleSetFolder) || empty($moduleSetFolder) || $moduleSetFolder == 1) {
            $overwrite = CLI::prompt($this->options['-s'] . ' are you sure?', ['y', 'n']);
            $this->module_set = \ucfirst('frontend');
        }

        if (@$overwrite == 'n') {
            return;
        }
        $this->module_folder = \ucfirst($moduleFolder);

        // mkdir($this->getPathCompany());
        // CLI::write($this->module_folder);

        try {
            CLI::write('Create Folder', 'cyan');
            CLI::newLine();
            CLI::showProgress(1, 8);
            CLI::wait(1, false);
            $this->generateFolderCompany();
            CLI::newLine();
            CLI::newLine();
            CLI::showProgress(2, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateSetFolder();
            CLI::newLine();
            CLI::showProgress(3, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateControllerFolder();
            CLI::newLine();
            CLI::showProgress(4, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateController();
            CLI::newLine();
            CLI::showProgress(5, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateConfigFolder();
            CLI::newLine();
            CLI::showProgress(6, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateConfig();
            CLI::newLine();
            CLI::showProgress(7, 8);
            CLI::wait(1, false);
            CLI::newLine();
            $this->generateModelsFolder();
            CLI::newLine();
            CLI::showProgress(8, 8);
            CLI::wait(1, false);
            CLI::newLine();
        } catch (\Exception $e) {
            CLI::error($e, 'red');
        }
        // CLI::clearScreen();
        // $this->module_name = ucfirst($this->module_name);
        // $module_folder         = $params['-f'] ?? CLI::getOption('f');
        // $this->module_folder   = ucfirst($module_folder ?? 'Modules');

        // if (\is_dir(\APPPATH . 'Modules/' . $this->module_name)) {
        //     CLI::error($this->string . $this->module_name . ' name is exists!', 'red');
        //     CLI::newLine();
        //     $overwrite = CLI::prompt('Overwrite? default[yes]', ['y', 'n']);
        // }

        // if (@$overwrite == 'n') {
        //     return;
        // }
        // CLI::write('oke', 'green');

    }

    protected function setController()
    {
        $controllerPath = $this->getFullPath('Controllers');

        // CLI::write($controllerPath);
        // return;
        if ($controllerPath) {
            CLI::error("Folder not found: " . $controllerPath);
            return;
        }
        \mkdir($controllerPath);

        if (!\file_exists($controllerPath . '/Dashboard.php')) {
            \file_put_contents($controllerPath . '/Dashboard.php', TemplateController::setTemplate($this->module_set, 'Modules\\' . $this->module_folder . '\\' . $this->module_set, 'Dashboard'));
        } else {
            CLI::error("Can't Create Controller! Old File Exists!");
        }
    }

    private function generateFolderCompany()
    {
        if ($this->getFullPath($this->getPathCompany())) {
            CLI::newLine();
            CLI::error('Folder: ' . $this->module_folder . ' is exists!', 'red');
            CLI::newLine();
            CLI::error('Skip Create Folder: ' . $this->module_folder, 'green');
            return;
        }

        $letsGenerate = mkdir($this->getPathCompany());

        if ($letsGenerate) {
            CLI::newLine();
            CLI::write('Create Folder Company/Author: ' . $this->module_folder .  ' create successfully!', 'green');
        } else {
            CLI::error('Create Folder Company/Author: ' . $this->module_folder .  ' failed!', 'red');
            CLI::newLine();
            // CLI::showProgress(2, 3);
            return;
        }

        // CLI::error('Ops, something wrong!', 'red');
        // return;
    }

    private function generateSetFolder()
    {
        if ($this->getFullPath($this->getPathSetModule())) {
            CLI::error('Folder: ' . $this->getPathSetModule() . ' is exists!', 'red');
            CLI::newLine();
            CLI::error('Skip Create Folder: ' . $this->getPathSetModule(), 'green');
            CLI::newLine();
            return;
        }

        $letsGenerate = mkdir($this->getPathSetModule());

        if ($letsGenerate) {
            CLI::write('Create Folder: ' . $this->module_set . ' create successfully!', 'green');
            CLI::newLine();
        } else {
            CLI::error('Create Folder: ' . $this->module_set .  ' failed!', 'red');
            CLI::newLine();
            return;
        }
    }

    private function generateControllerFolder()
    {
        if ($this->getFullPath($this->getPathController())) {
            CLI::error('Folder: ' . $this->getPathController() . ' is exists!', 'red');
            CLI::newLine();
            CLI::error('Skip Create Folder: ' . $this->getPathController(), 'green');
            CLI::newLine();
            return;
        }

        $letsGenerate = mkdir($this->getPathController());

        if ($letsGenerate) {
            CLI::write('Create Folder: Controllers create successfully!', 'green');
            CLI::newLine();
        } else {
            CLI::error('Create Folder: Controllers failed!', 'red');
            CLI::newLine();
            return;
        }
    }

    private function generateController()
    {
        if (!\file_exists($this->getPathController() . '/Dashboard.php')) {
            if (\file_put_contents($this->getPathController() . '/Dashboard.php', TemplateController::setTemplate($this->module_set, 'Modules\\' . $this->module_folder . '\\' . $this->module_set, 'Dashboard'))) {
                CLI::write('Create File: Controllers create successfully!', 'green');
                CLI::newLine();
            } else {
                CLI::error('Create File: Controllers failed, please try again.', 'red');
                CLI::newLine();
                return;
            }
        } else {
            CLI::error('Create File: Controllers/Dashboard.php failed!, File is exists.', 'red');
            CLI::newLine();
            return;
        }
    }

    private function generateConfigFolder()
    {
        if ($this->getFullPath($this->getPathConfig())) {
            CLI::error('Folder: ' . $this->getPathConfig() . ' is exists!', 'red');
            CLI::newLine();
            CLI::error('Skip Create Folder: ' . $this->getPathConfig(), 'green');
            CLI::newLine();
            return;
        }

        $letsGenerate = mkdir($this->getPathConfig());

        if ($letsGenerate) {
            CLI::write('Create Folder: Config create successfully!', 'green');
            CLI::newLine();
        } else {
            CLI::error('Create Folder: Config failed!', 'red');
            CLI::newLine();
            return;
        }
    }

    private function generateConfig()
    {
        if (!\file_exists($this->getPathConfig() . '/Routes.php')) {
            if (\file_put_contents($this->getPathConfig() . '/Routes.php', TemplateConfig::setTemplate($this->module_folder, 'Modules\\' . $this->module_folder . '\\' . $this->module_set . '\Controllers'))) {
                CLI::write('Create File: Routes.php create successfully!', 'green');
                CLI::newLine();
            } else {
                CLI::error('Create File: Routes.php failed, please try again.', 'red');
                CLI::newLine();
                return;
            }
        } else {
            CLI::error('Create File: Routes.php failed!, File is exists.', 'red');
            CLI::newLine();
            return;
        }
    }

    private function generateModelsFolder()
    {
        if ($this->getFullPath($this->getPathModels())) {
            CLI::error('Folder: ' . $this->getPathModels() . ' is exists!', 'red');
            CLI::newLine();
            CLI::error('Skip Create Folder: ' . $this->getPathModels(), 'green');
            CLI::newLine();
            return;
        }

        $letsGenerate = mkdir($this->getPathModels());

        if ($letsGenerate) {
            CLI::write('Create Folder: Models create successfully!', 'green');
            CLI::newLine();
        } else {
            CLI::error('Create Folder: Models failed!', 'red');
            CLI::newLine();
            return;
        }
    }

    private function getPathController()
    {
        return (string) $this->getPathSetModule() . '/Controllers';
    }

    private function getPathConfig()
    {
        return (string) $this->getPathSetModule() . '/Config';
    }

    private function getPathModels()
    {
        return (string) $this->getPathSetModule() . '/Models';
    }

    private function getPathCompany()
    {
        return (string) \APPPATH . 'Modules/' . $this->module_folder;
    }

    private function getPathSetModule()
    {
        return (string) $this->getPathCompany() . '/' . $this->module_set;
    }

    private function getFullPath(string $path = null)
    {
        if (\is_null($path) || !\is_string($path)) {
            CLI::write('Path must be string!', 'red');
            return;
        }

        if (\is_dir($path)) {
            return true;
        }

        return false;
    }

    private function setModule(string $setModule = null)
    {
        $setModules = '';
        if (\is_null($setModule) || empty($setModule)) {
            $setModules = 'Modules\\' . $this->module_name . '\\Frontend';
        } else {
            $setModules = 'Modules\\' . $this->module_name . '\\' . $this->module_set;
        }
    }
}
