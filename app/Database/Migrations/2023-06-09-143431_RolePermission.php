<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolePermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'updated_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'deleted_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
        ]);

        $this->forge->addKey(['role_id', 'permission_id']);
        $this->forge->addForeignKey('role_id', 'role', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'permission', 'id', '', 'CASCADE');
        $this->forge->createTable('role_permission');
    }

    public function down()
    {
        $this->forge->dropTable('role_permission');
    }
}
