<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'institution' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'address' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'book_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'publisher' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'publication_year' => [
                'type'       => 'YEAR',
                'null'      => true,
            ],
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'      => true,
            ],
            'issn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'      => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'book_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'      => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'accepted', 'rejected'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'      => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'      => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'      => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('donations');
    }

    public function down()
    {
        $this->forge->dropTable('donations');
    }
}
