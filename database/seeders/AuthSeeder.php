<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Создание прав*/
        Permission::create(['name' => 'delete wells']);
        Permission::create(['name' => 'save wells']);
        Permission::create(['name' => 'read wells']);

        /*Создание ролей*/
        $roleRead = Role::create(['name' => 'reader']);
        $roleSave = Role::create(['name' => 'saver']);
        $roleDelete = Role::create(['name' => 'deleter']);
        $roleAdmin = Role::create(['name' => 'admin']);  // Admin role

        /*Назначение прав ролям*/
        $roleRead->givePermissionTo('read wells');

        $roleSave->givePermissionTo('save wells');
        $roleSave->givePermissionTo('read wells');

        $roleDelete->givePermissionTo('delete wells');
        $roleDelete->givePermissionTo('read wells');

        /*Admin имеет все права*/
        $roleAdmin->givePermissionTo(Permission::all());

        /*Создание пользователей и назначение ролей*/
        $reader = User::create(['name' => 'Reader User', 'email' => 'reader@gmail.com', 'password' => bcrypt('12345678')]);
        $reader->assignRole('reader');

        $saver = User::create(['name' => 'Saver User', 'email' => 'saver@gmail.com', 'password' => bcrypt('12345678')]);
        $saver->assignRole('saver');

        $deleter = User::create(['name' => 'Deleter User', 'email' => 'deleter@gmail.com', 'password' => bcrypt('12345678')]);
        $deleter->assignRole('deleter');

        /*Создание пользователя admin*/
        $admin = User::create(['name' => 'Admin User', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678')]);
        $admin->assignRole('admin');
    }
}
