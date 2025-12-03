<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJobImage extends Migration
{
    public function up()
    {
        $fields = [
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ];
        $this->forge->addColumn('jobs', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jobs', 'image');
    }
}

