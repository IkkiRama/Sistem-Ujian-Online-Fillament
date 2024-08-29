<?php

namespace App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\TryoutAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tryout extends Model
{
    use HasFactory;
    protected $guarded = ["id"];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function tryout_answers(): HasMany
    {
        return $this->hasMany(TryoutAnswer::class);
    }
}
