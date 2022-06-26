<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create(['name' => 'Editar registros']);
         Permission::create(['name' => 'Eliminar registros']);
         Permission::create(['name' => 'Crear registros']);
         Permission::create(['name' => 'Asignar roles y permisos']);
         Permission::create(['name' => 'Generar reportes']);

         $role = Role::create(['name' => 'Super-admin']);
         $user = User::create([
            'name' => 'Francisco',
            'lastname' => 'Zepeda',
            'email' => 'superAdminCL@gmail.com',
            'password' => bcrypt('Super@dminCL2022')
        ]);
        $user->assignRole('Super-admin');
        $role->givePermissionTo(Permission::all());
 
    }
}
