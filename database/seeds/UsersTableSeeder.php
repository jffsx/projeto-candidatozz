<?php

use Illuminate\Database\Seeder;
use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Users\Models\Role;
use Candidatozz\Domains\Candidates\Models\Candidate;

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

        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'Candidate',
            'email' => 'user@candidate.com',
            'password' => app('hash')->make('1234'),
        ]);

        $candidate = Candidate::create([
            'first_name' => 'Candidate',
            'last_name' => 'Eduzz',
            'email' => 'user@candidate.com',
            'gender' => 'male',
        ]);

        $candidate->user()->associate($user);
        $candidate->save();

        $role = Role::where('code', Role::ROLE_CANDIDATE)->first();
        $user->roles()->attach($role);
    }
}
