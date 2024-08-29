<?php

namespace App\Models;

use App\Models\TryoutAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionOption extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function tryout_answers(): HasMany
    {
        return $this->hasMany(TryoutAnswer::class);
    }
}
