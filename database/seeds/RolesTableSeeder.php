<?php

use Illuminate\Database\Seeder;
use Candidatozz\Domains\Users\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Administrador', 'code' => 'administrator'],
            ['name' => 'Candidato', 'code' => 'candidate']
        ]);
    }
}
