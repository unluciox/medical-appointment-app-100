<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GenericSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles2 =[
            'dog',
            'cat',
            'bird',
            'among_us'
        ];
        foreach ($roles2 as $role2){
            Role::create([
                'name' => $role2
            ]);
        }
    }
}
//primero va ell seeder
//