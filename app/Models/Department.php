<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    function filieres(): HasMany {
        return $this->hasMany(Filiere::class);
    }

    function pathItems(): HasManyThrough {
        return $this->hasManyThrough(PathItem::class, Filiere::class);
    }
}
