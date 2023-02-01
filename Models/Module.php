<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Module extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        "name",
        //"enabled",
        "installed",
    ];

    protected $casts = [
        "name"=>"string",
        //"enabled"=>"boolean",
        "installed"=>"boolean",
    ];
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\ModuleFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['name',"installed"]);
    }
}
