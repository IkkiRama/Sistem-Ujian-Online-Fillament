<?php

namespace App\Livewire;

use App\Models\Tryout;
use App\Models\Package;
use App\Models\QuestionOption;
use App\Models\TryoutAnswer;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TryoutOnline extends Component
{

    public $tryout;
    public $package;
    public $timeLeft;
    public $questions; // per row yang ada di tabel package question
    public $tryoutAnswers;
    public $selectedAnswers = [];
    public $currentPackageQuestion;

    function mount($id) {
        $this->package = Package::with("questions.question.options")->find($id);

        if ($this->package) {
            $this->questions = $this->package->questions;

            if ($this->questions->isNotEmpty()) {
                $this->currentPackageQuestion = $this->questions->first();
            }
        }

        $this->tryout = Tryout::where('user_id', Auth::id())
                        ->where('package_id', $this->package->id)
                        ->whereNull('finished_at')
                        ->first();


        if (!$this->tryout) {
            $stardedAt = now();
            $durationInSecond = $this->package->duration * 60;

            $this->tryout = Tryout::create([
                'user_id' => Auth::id(),
                'package_id' => $this->package->id,
                'duration' => $durationInSecond,
                'started_at' => $stardedAt,
            ]);

            foreach ($this->questions as $question) {
                TryoutAnswer::create([
                    'tryout_id' => $this->tryout->id,
                    'question_id' => $question->question_id,
                    'question_option_id' => null,
                    'score' => 0,
                ]);
            }
        }

        $this->tryoutAnswers = TryoutAnswer::where('tryout_id', $this->tryout->id)->get();

        foreach ($this->tryoutAnswers as $answer) {
            $this->selectedAnswers[$answer->question_id] = $answer->question_option_id;
        }

        $this->calculatedTimeLest();

    }
    public function render()
    {
        return view('livewire.tryout');
    }

    function goToQuestion($package_question_id) {
        $this->currentPackageQuestion = $this->questions->where('id', $package_question_id)->first();
        $this->calculatedTimeLest();
    }

    protected function calculatedTimeLest() {
        if ($this->tryout->finished_at) {
            $this->timeLeft = 0;
            return;
        }

        $now = time();
        $startedAt = strtotime($this->tryout->started_at);

        $sisaWaktu = $now - $startedAt;

        if ($sisaWaktu < 0) {
            $this->timeLeft = 0;
        }else{
            $this->timeLeft = max(0, $this->tryout->duration - $sisaWaktu);
        }


    }

    function saveAnswer($questionId, $optionId) {

        $option = QuestionOption::find($optionId);
        $score = $option->score ?? 0;

        $tryoutAnswer = TryoutAnswer::where("tryout_id", $this->tryout->id)
                        ->where("question_id", $questionId)
                        ->first();

        if ($tryoutAnswer) {
            $tryoutAnswer->update([
                'question_option_id' => $optionId,
                'score' => $score
            ]);
        }

        $this->tryoutAnswers = TryoutAnswer::where('tryout_id', $this->tryout->id)->get();

        foreach ($this->tryoutAnswers as $answer) {
            $this->selectedAnswers[$answer->question_id] = $answer->question_option_id;
        }

        $this->calculatedTimeLest();

    }
}
