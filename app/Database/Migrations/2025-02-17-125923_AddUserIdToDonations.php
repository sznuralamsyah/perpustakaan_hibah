<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToDonations extends Migration
{
    public function up()
    {
        $this->forge->addColumn('donations', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'unsigned'   => true,
                'after'      => 'id', 
            ],
            'CONSTRAINT donations_user_id_foreign FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE'
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('donations', 'donations_user_id_foreign');
        $this->forge->dropColumn('donations', 'user_id');
    }
}
