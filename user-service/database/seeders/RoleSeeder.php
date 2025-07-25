<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $roles = [
            ['name' => 'admin', 'label' => 'Administrador'],
            ['name' => 'courier', 'label' => 'Entregador'],
            ['name' => 'customer', 'label' => 'Cliente'],
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']],
                ['label' => $roleData['label'], 'guard_name' => 'api']
            );
        }
    }
}
