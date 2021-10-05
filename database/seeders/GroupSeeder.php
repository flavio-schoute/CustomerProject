<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Group::factory(8)->create();
        Group::create([
            'name' => 'Groep 1'
        ]);

        Group::create([
            'name' => 'Groep 2'
        ]);

        Group::create([
            'name' => 'Groep 3'
        ]);
    }
}
