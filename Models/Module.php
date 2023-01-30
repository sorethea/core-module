<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "enabled",
        "installed",
    ];

    protected $casts = [
        "name"=>"string",
        "enabled"=>"boolean",
        "installed"=>"boolean",
    ];
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\ModuleFactory::new();
    }
}
