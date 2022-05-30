<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'time', 'cinema_id'];

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }
}
