<?php

namespace App\Livewire;

use App\Models\Package;
use Livewire\Component;

class Tryout extends Component
{

    public $package;
    public $questions;
    public $currentQuestion;

    function mount($id) {
        $this->package = Package::with("questions.question.options")->find($id);

        if ($this->package) {
            $this->questions = $this->package->questions;

            if ($this->questions->isNotEmpty()) {
                $this->currentQuestion = $this->questions->first();
            }
        }

    }
    public function render()
    {
        return view('livewire.tryout');
    }

    function goToQuestion($index) {
        $this->currentQuestion = $this->questions[$index];
    }
}
