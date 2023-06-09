<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'updated_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'deleted_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
        ]);

        $this->forge->addKey(['user_id', 'permission_id']);
        $this->forge->addForeignKey('user_id', 'user', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'permission', 'id', '', 'CASCADE');
        $this->forge->createTable('user_permission');
    }

    public function down()
    {
        $this->forge->dropTable('user_permission');
    }
}
