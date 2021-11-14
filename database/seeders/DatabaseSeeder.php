<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \App\Models\User::create([
            'name' => 'Glade Admin',
            'email' => 'superadmin@admin.com',
            'password' => \Hash::make('password'),
            'usertype' => 'super-admin'
        ]);

        $perms = ['companies','employees','admins','permissions'];

        foreach ($perms as $key => $perm) {
            \App\Models\Permissions::create([
                'slug' => $perm,
                'usertype' => 'super-admin',
                'grants' => 'create,read,update,delete'
            ]);
        }
    }
}
