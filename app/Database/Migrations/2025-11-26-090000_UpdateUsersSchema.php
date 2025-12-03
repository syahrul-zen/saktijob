<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUsersSchema extends Migration
{
    public function up()
    {
        // Ensure table exists
        if (! $this->db->tableExists('users')) {
            return;
        }

        // Add 'role' column if not exists (admin, perusahaan, user)
        if (! $this->db->fieldExists('role', 'users')) {
            $fields = [
                'role' => [
                    'type'       => 'ENUM',
                    'constraint' => ['admin', 'perusahaan', 'user'],
                    'default'    => 'user',
                    'null'       => false,
                ],
            ];
            $this->forge->addColumn('users', $fields);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('users') && $this->db->fieldExists('role', 'users')) {
            $this->forge->dropColumn('users', 'role');
        }
    }
}
