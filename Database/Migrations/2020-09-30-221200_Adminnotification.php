<?php

namespace Codenom\Framework\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adminnotification extends Migration
{
	public function up()
	{
		// Drop table 'adminnotification' if it exists
		$this->forge->dropTable('adminnotification', true);

		//data migrate
		$this->forge->addField([
			'notification_id' => [
				'type' => 'INT',
				'constraint' => '10',
				'unsigned'       => true,
				'auto_increment' => true,
				'comment' => 'Notification ID',
			],
			'severity' => [
				'type' => 'SMALLINT',
				'default' => '0',
				'comment' => 'Problem Type',
			],
			'date_added' => [
				'type' => 'TIMESTAMP',
				'default' => 'CURRENT_TIMESTAMP',
				'comment' => 'Date Added',
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'default' => 'No Title',
				'comment' => 'Title',
			],
			'description' => [
				'type' => 'TEXT',
				'null' => TRUE,
				'comment' => 'Description',
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
				'comment' => 'URL Notification',
			],
			'is_read' => [
				'type' => 'SMALLINT',
				'constraint' => '5',
				'null' => FALSE,
				'default' => '0',
				'comment' => 'Flag if notification read',
			],
			'is_remove' => [
				'type' => 'SMALLINT',
				'constraint' => '5',
				'null' => FALSE,
				'default' => '0',
				'comment' => 'Flag if notification might be removed',
			],
			'expiration_data' => [
				'type' => 'DATETIME',
				'null' => TRUE,
			],
			'image_url' => [
				'type' => 'TEXT',
				'null' => TRUE,
			]
		]);
		$this->forge->addKey('notification_id', true);
		$this->forge->addKey('severity');
		$this->forge->addKey('is_read');
		$this->forge->addKey('is_remove');
		$this->forge->createTable('adminnotification', false);
	}

	public function down()
	{
		//
		$this->forge->dropTable('adminnotification', true);
	}
}
