<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email    = 'admin@admin.com';
        $password = 'admin';

        $usersTable         = $this->db->table('users');
        $identitiesTable    = $this->db->table('auth_identities');
        $groupsUsersTable   = $this->db->table('auth_groups_users');

        $existingUser = $usersTable->where('email', $email)->get()->getRow();

        if (! $existingUser) {
            $usersTable->insert([
                'email'      => $email,
                'password'   => password_hash($password, PASSWORD_DEFAULT),
                'role'       => 'admin',
                'active'     => 1,
                'created_at' => Time::now()->toDateTimeString(),
                'updated_at' => Time::now()->toDateTimeString(),
            ]);

            $userId = (int) $this->db->insertID();

            // Add single identity email_password for Shield
            $identitiesTable->insert([
                'user_id'    => $userId,
                'type'       => 'email_password',
                'secret'     => $email,
                'secret2'    => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => Time::now()->toDateTimeString(),
                'updated_at' => Time::now()->toDateTimeString(),
            ]);

            $groupsUsersTable->insert([
                'user_id' => $userId,
                'group'   => 'admin',
            ]);
        } else {
            $userId = (int) $existingUser->id;

            $usersTable->where('id', $userId)->update([
                'role'       => 'admin',
                'updated_at' => Time::now()->toDateTimeString(),
            ]);

            // Ensure email_password identity exists
            $emailPasswordIdentity = $identitiesTable->where('user_id', $userId)->where('type', 'email_password')->get()->getRow();
            if (! $emailPasswordIdentity) {
                $identitiesTable->insert([
                    'user_id'    => $userId,
                    'type'       => 'email_password',
                    'secret'     => $email,
                    'secret2'    => password_hash($password, PASSWORD_DEFAULT),
                    'created_at' => Time::now()->toDateTimeString(),
                    'updated_at' => Time::now()->toDateTimeString(),
                ]);
            }

            $inGroup = $groupsUsersTable->where('user_id', $userId)->where('group', 'admin')->get()->getRow();
            if (! $inGroup) {
                $groupsUsersTable->insert([
                    'user_id' => $userId,
                    'group'   => 'admin',
                ]);
            }
        }
    }
}
