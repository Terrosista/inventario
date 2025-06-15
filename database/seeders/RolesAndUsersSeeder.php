<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $empleadoRole = Role::firstOrCreate(['name' => 'empleado']);
        $auditorRole = Role::firstOrCreate(['name' => 'auditor']);

        // Crear usuarios
        $admin = User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        $empleado = User::firstOrCreate(
            ['email' => 'empleado@demo.com'],
            ['name' => 'Empleado', 'password' => bcrypt('password')]
        );

        $auditor = User::firstOrCreate(
            ['email' => 'auditor@demo.com'],
            ['name' => 'Auditor', 'password' => bcrypt('password')]
        );

        // Asignar roles
        $admin->assignRole($adminRole);
        $empleado->assignRole($empleadoRole);
        $auditor->assignRole($auditorRole);
    }
}
