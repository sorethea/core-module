<?php

namespace Modules\Core\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $role = Role::findOrCreate("Admin");
        $module = "core";
        $models =[
            "users",
            "roles",
            "permissions",
        ];
        foreach ($models as $model){
            Permission::findOrCreate($model.'.viewAny');
            Permission::findOrCreate($model.'.view');
            Permission::findOrCreate($model.'.create');
            Permission::findOrCreate($model.'.update');
            Permission::findOrCreate($model.'.delete');
            Permission::findOrCreate($model.'.restore');
            Permission::findOrCreate($model.'.forceDelete');
            $manage = Permission::findOrCreate($model.'.manager');
            $role->givePermissionTo($manage);
        }
        $user = User::create([
            "name"=>"Administrator",
            "email"=>"admin@demo.com",
            "password"=>Hash::make("12345678"),
        ]);
        $user->assignRole($role);

    }
}
