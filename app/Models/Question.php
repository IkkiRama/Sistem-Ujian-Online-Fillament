<?php

namespace App\Models;

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
}
