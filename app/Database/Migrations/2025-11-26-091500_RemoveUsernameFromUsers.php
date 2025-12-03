<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveUsernameFromUsers extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('users') && $this->db->fieldExists('username', 'users')) {
            $this->forge->dropColumn('users', 'username');
        }
    }

    public function down()
    {
        if ($this->db->tableExists('users') && ! $this->db->fieldExists('username', 'users')) {
            $fields = [
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                ],
            ];
            $this->forge->addColumn('users', $fields);
        }
    }
}

