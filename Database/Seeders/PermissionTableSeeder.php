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
            "modules",
            "Settings",
            "activities",
        ];
        foreach ($models as $model){
            $levels = [
                'viewAny',
                'view',
                'create',
                'update',
                'delete',
                'forceDelete',
                'manager',
            ];
            foreach ($levels as $level){
                $permission = Permission::findOrCreate($model.'.'.$level);
                if(!empty($permission)){
                    $permission->module = $module;
                    $permission->save();
                    if($level=="manager"){
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
        $user = User::create([
            "name"=>"Administrator",
            "email"=>"admin@demo.com",
            "password"=>Hash::make("12345678"),
        ]);
        $user->assignRole($role);
    }
}
