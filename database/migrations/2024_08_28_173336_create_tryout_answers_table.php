<?php

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Tryout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tryout_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tryout::class)->cascadeOnDelete();
            $table->foreignIdFor(Question::class)->cascadeOnDelete();
            $table->foreignIdFor(QuestionOption::class)->nullable()->cascadeOnDelete();
            $table->integer("score")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_answers');
    }
};
