<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Token extends Migration
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
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'token' => ['type' => 'varchar', 'constraint' => 255, 'default' => null],
            'created_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
            'expire_at' => ['type' => 'datetime', 'null' => true, 'default' => null],
        ]);

        $this->forge->addKey(['id', 'user_id']);
        $this->forge->addForeignKey('user_id', 'user', 'id', '', 'CASCADE');
        $this->forge->createTable('token');
    }

    public function down()
    {
        $this->forge->dropTable('token');
    }
}
