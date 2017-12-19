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
        Role::create(
            [
                'name' => 'Administrador',
                'code' => 'administrador',
            ],
            [
                'name' => 'Candidato',
                'code' => 'candidato',
            ]
        );
    }
}
