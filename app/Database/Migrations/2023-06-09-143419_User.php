<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'TEXT',
            ],
            'created_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'updated_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'deleted_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'created_by' => ['type' => 'int', 'null' => true, 'default' => null],
            'updated_by' => ['type' => 'int', 'null' => true, 'default' => null],
            'deleted_by' => ['type' => 'int', 'null' => true, 'default' => null],
            'isdeleted' => ['type' => 'int', 'null' => true, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
