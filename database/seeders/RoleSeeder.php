<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::createOrRestore([
            'name' => RoleEnum::ADMIN
        ]);
        Role::createOrRestore([
            'name' => RoleEnum::USER
        ]);
    }
}
