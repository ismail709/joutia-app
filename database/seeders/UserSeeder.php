<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
        
        if ($adminRole) {
            User::factory()->create([
                'email' => 'admin@joutia.ma',
                'role_id' => $adminRole->id
            ]);
        }else {
            throw new \Exception('Admin role not found!');
        }
        
        $userRole = Role::where('name', RoleEnum::USER->value)->first();

        if ($userRole) {
            User::factory(10000)->create([
                'role_id' => $userRole->id
            ]);
        }else {
            throw new \Exception('User role not found!');
        }


    }
}
