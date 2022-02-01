<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PathItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    function path(): BelongsTo {
        return $this->belongsTo(Path::class);
    }

    function filiere(): BelongsTo {
        return $this->belongsTo(Filiere::class);
    }
}
