<?php

namespace Codenom\Framework\Database\Migrations;

class Oauth extends \CodeIgniter\Database\Migration
{

	//setup grouping migrate
	// protected $DBGroup = 'oauth';

	public function up()
	{
		//--- migrate for table oauth_clients -->

		// Drop table 'oauth_clients' if it exists
		$this->forge->dropTable('oauth_clients', true);

		//data migrate
		$this->forge->addField([
			'client_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => FALSE
			],
			'client_secret' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'redirect_uri' => [
				'type' => 'VARCHAR',
				'constraint' => '2000',
				'null' => TRUE
			],
			'grant_types' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
		]);

		$this->forge->addKey('client_id', true);
		$this->forge->createTable('oauth_clients');

		//--- migrate for table oauth_access_tokens -->

		// Drop table 'oauth_access_tokens' if it exists
		$this->forge->dropTable('oauth_access_tokens', true);

		//data migrate
		$this->forge->addField([
			'access_token' => [
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			],
			'client_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => FALSE
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => FALSE
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
		]);

		$this->forge->addKey('access_token', true);
		$this->forge->createTable('oauth_access_tokens');

		//--- migrate for table oauth_authorization_codes -->

		// Drop table 'oauth_authorization_codes' if it exists
		$this->forge->dropTable('oauth_authorization_codes', true);

		//data migrate
		$this->forge->addField([
			'authorization_code' => [
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			],
			'client_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'redirect_uri' => [
				'type' => 'VARCHAR',
				'constraint' => '2000',
				'null' => TRUE
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => FALSE
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
			'id_token' => [
				'type' => 'VARCHAR',
				'constraint' => '1000',
				'null' => TRUE
			],
		]);

		$this->forge->addKey('authorization_code', true);
		$this->forge->createTable('oauth_authorization_codes');

		//--- migrate for table oauth_refresh_tokens -->

		// Drop table 'oauth_refresh_tokens' if it exists
		$this->forge->dropTable('oauth_refresh_tokens', true);

		//data migrate
		$this->forge->addField([
			'refresh_token' => [
				'type' => 'VARCHAR',
				'constraint' => '40',
				'null' => FALSE
			],
			'client_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => FALSE
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => FALSE
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
		]);

		$this->forge->addKey('refresh_token', true);
		$this->forge->createTable('oauth_refresh_tokens');

		//--- migrate for table oauth_users -->

		// Drop table 'oauth_users' if it exists
		$this->forge->dropTable('oauth_users', true);

		//data migrate
		$this->forge->addField([
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => FALSE
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'first_name' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'last_name' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
			'email_verified' => [
				'type' => 'BOOLEAN',
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
		]);

		$this->forge->addKey('username', true);
		$this->forge->createTable('oauth_users');

		//--- migrate for table oauth_scopes -->

		// Drop table 'oauth_scopes' if it exists
		$this->forge->dropTable('oauth_scopes', true);

		//data migrate
		$this->forge->addField([
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
				'null' => TRUE
			],
			'email_verified' => [
				'type' => 'BOOLEAN',
			],
		]);

		$this->forge->addKey('scope', true);
		$this->forge->createTable('oauth_scopes');

		//--- migrate for table oauth_jwt -->

		// Drop table 'oauth_jwt' if it exists
		$this->forge->dropTable('oauth_jwt', true);

		//data migrate
		$this->forge->addField([
			'client_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => FALSE
			],
			'subject' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
				'null' => TRUE
			],
			'public_key' => [
				'type' => 'VARCHAR',
				'constraint' => '2000',
				'null' => FALSE
			],
		]);
		$this->forge->createTable('oauth_jwt');
	}

	public function down()
	{
		//
		$this->forge->dropTable('oauth_clients', true);
		$this->forge->dropTable('oauth_access_token', true);
		$this->forge->dropTable('oauth_authorization_codes', true);
		$this->forge->dropTable('oauth_refresh_tokens', true);
		$this->forge->dropTable('oauth_users', true);
		$this->forge->dropTable('oauth_jwt', true);
	}
}
