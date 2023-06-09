<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'role_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'updated_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'deleted_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
        ]);

        $this->forge->addKey(['user_id', 'role_id']);
        $this->forge->addForeignKey('user_id', 'user', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'role', 'id', '', 'CASCADE');
        $this->forge->createTable('user_role');
    }

    public function down()
    {
        $this->forge->dropTable('user_role');
    }
}
