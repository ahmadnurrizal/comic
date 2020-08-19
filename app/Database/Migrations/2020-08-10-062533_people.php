<?php
// migration used to create database with code. this can help us if we wanna share our project. so database will created automatically
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class People extends Migration
{
	public function up()
	{
		$this->forge->addField([ // making structure of database by code
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'street' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'created_at' => [
				'type'					=> 'DATETIME',
				'null'					=> TRUE,
			],
			'updated-at' => [
				'type'					=> 'DATETIME',
				'null'					=> TRUE,
			]
		]);
		$this->forge->addKey('id', true); // mark id as primary key
		$this->forge->createTable('people'); // create database
	}

	public function down()
	{
		$this->forge->dropTable('people'); // erase database
	}
}
