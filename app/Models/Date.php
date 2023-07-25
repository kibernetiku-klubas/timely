<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Date extends Model
{
    use HasFactory;

    protected $table = 'dates';

    protected $fillable = ['date_and_time', 'voted_by'];
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }
}
