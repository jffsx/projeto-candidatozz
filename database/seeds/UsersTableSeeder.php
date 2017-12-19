<?php

use Illuminate\Database\Seeder;
use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Users\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'Admin',
            'email' => 'user@admin.com',
            'password' => app('hash')->make('1234'),
        ]);

        $role = Role::where('code', Role::ROLE_ADMIN)->first();
        $user->roles()->attach($role);
    }
}
