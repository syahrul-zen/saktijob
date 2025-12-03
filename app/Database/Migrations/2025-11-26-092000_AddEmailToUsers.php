<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToUsers extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('users') && ! $this->db->fieldExists('email', 'users')) {
            $fields = [
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'unique'     => true,
                    'null'       => true,
                ],
            ];
            $this->forge->addColumn('users', $fields);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('users') && $this->db->fieldExists('email', 'users')) {
            $this->forge->dropColumn('users', 'email');
        }
    }
}

