<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['date_id', 'voted_by'];

    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }
}
