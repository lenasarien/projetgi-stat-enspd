<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Path extends Model
{
    use HasFactory;

    protected $guarded = [];

    function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }

    function bac(): BelongsTo {
        return $this->belongsTo(Bac::class);
    }

    function license(): BelongsTo {
        return $this->belongsTo(License::class);
    }

    function cycle(): BelongsTo {
        return $this->belongsTo(Cycle::class);
    }
}
