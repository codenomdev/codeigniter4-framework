<?php

namespace Codenom\Framework\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoreConfigData extends Migration
{
	public function up()
	{
		//--- migrate for table core_config_data -->
		// Drop table 'core_config_data' if it exists
		$this->forge->dropTable('core_config_data', true);
		$this->forge->addField([
			'config_id' => [
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => true,
				'auto_increment' => true,
				'comment' => 'Config ID',
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '8',
				'default' => 'default',
				'null' => FALSE,
				'commnet' => 'Config Scope',
			],
			'scope_id' => [
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE,
				'default' => '0',
				'comment' => 'Config Scope ID',
			],
			'path' => [
				'type' => 'VARCHAR',
				'contraint' => '255',
				'null' => FALSE,
				'default' => 'general',
				'comment' => 'Config Path',
			],
			'value' => [
				'type' => 'text',
				'null' => TRUE,
				'comment' => 'Config Value',
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'default' => 'CURRENT_TIMESTAMP',
				'comment' => 'Updated at',
			]
		]);

		$this->forge->addKey('config_id', true);
		$this->forge->addKey('scope');
		$this->forge->addKey('scope_id');
		$this->forge->addKey('path');
		$this->forge->createTable('core_config_data');
	}

	public function down()
	{
		//
		$this->forge->dropTable('core_config_data', true);
	}
}
