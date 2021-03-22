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
	protected $name = 'setup:route';

	/**
	 * The Command's short description
	 *
	 * @var string
	 */
	protected $description = 'Create route module';

	/**
	 * The Command's usage
	 *
	 * @var string
	 */
	protected $usage = 'command:name [arguments] [options]';

	/**
	 * The Command's arguments.
	 *
	 * @var array
	 */
	protected $arguments = [];

	/**
	 * The Command's options.
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Actually execute a command.
	 *
	 * @param array $params
	 */
	public function run(array $params)
	{
		//
	}
}
