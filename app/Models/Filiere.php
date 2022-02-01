<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    use HasFactory;

    protected $guarded = [];

    function cycle(): BelongsTo {
        return $this->belongsTo(Cycle::class);
    }

    function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }

    function pathItems(): HasMany {
        return $this->hasMany(PathItem::class);
    }
}
