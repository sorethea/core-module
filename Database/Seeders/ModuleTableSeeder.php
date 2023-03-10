<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        \Module::enable("core");
        //\Core::installModule("core");
        //$module = Module::firstOrCreate(["name" => "Core"]);
        //\Core::install("core");
    }
}
