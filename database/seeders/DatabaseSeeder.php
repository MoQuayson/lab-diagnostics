<?php

namespace Database\Seeders;

use App\Models\{Role, Permission, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //$role = Role::create(['id' => (string)Str::uuid(),'name' => Role::ADMIN]);
        $role = Role::create(['name' => Role::ADMIN]);
        $permissions = collect([
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            //Appointment Permission
            'appointment-list',
            'appointment-create',
            'appointment-edit',
            'appointment-delete',

            //Tests Permission
            'test-list',
            'test-create',
            'test-edit',
            'test-delete',


        ])->map(fn ($permission) => Permission::create(['name' => $permission]))
            ->map(fn ($permission) => $permission->name);

        $user = User::create([
            'name' => 'Moses Quayson',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'telephone'=> '1234567890',
            'gender'=>'male'
        ]);


        $role->syncPermissions($permissions);

        $user->syncRoles([$role->name]);
    }
}
