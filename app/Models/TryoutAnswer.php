<?php

namespace App\Models;

use App\Models\Tryout;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TryoutAnswer extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function tryout(): BelongsTo
    {
        return $this->belongsTo(Tryout::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function question_option(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class);
    }
}
