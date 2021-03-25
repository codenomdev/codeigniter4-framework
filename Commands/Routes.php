<?php

namespace Codenom\Framework\Commands;

use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\GeneratorTrait;

class Routes extends BaseCommand
{
	use GeneratorTrait;

	/**
	 * The group the command is lumped under
	 * when listing commands.
	 *
	 * @var string
	 */
	protected $group = 'Codenom';

	/**
	 * The Command's name
	 *
	 * @var string
	 */
	protected $name = 'make:route';

	/**
	 * The Command's short description
	 *
	 * @var string
	 */
	protected $description = 'Generates a new route file.';

	/**
	 * The Command's usage
	 *
	 * @var string
	 */
	protected $usage = 'make:route [arguments] [options]';

	/**
	 * The Command's arguments.
	 *
	 * @var array
	 */
	protected $arguments = [
		'module' => 'Name of Module.',
		// 'route (from)' => 'Name of route. Example: test',
		// 'controller' => 'Name of Controller for create route',
	];

	/**
	 * The Command's options.
	 *
	 * @var array
	 */
	protected $options = [
		// '--module' => 'Name of module. Example: Vendor_Module.',
		'--type' => 'Type Route. Available type: default, core.',
		'--route' => 'Name of route. Example: dashboard.',
		'--controller' => 'Name of Controller for create route.',

	];

	/**
	 * Actually execute a command.
	 *
	 * @param array $params
	 */
	public function run(array $params)
	{
		$this->component = 'Route';
		$this->directory = 'Models';
		$this->template  = 'route.tpl.php';

		$this->classNameLang = 'Module Name';
		$this->execute($params);
	}

	/**
	 * Prepare options and do the necessary replacements.
	 *
	 * @param string $class
	 *
	 * @return string
	 */
	protected function prepare(string $class)
	{
	}
}
