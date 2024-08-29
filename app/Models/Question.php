<?php

namespace App\Models;

use App\Models\TryoutAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(PackageQuestion::class);
    }

    public function tryout_answers(): HasMany
    {
        return $this->hasMany(TryoutAnswer::class);
    }
}
