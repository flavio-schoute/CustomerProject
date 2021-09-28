<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Role::factory(3)->create();
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'Docent'
        ]);

        Role::create([
            'name' => 'Gebruiker'
        ]);
    }
}
