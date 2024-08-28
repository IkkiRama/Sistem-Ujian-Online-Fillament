<?php

namespace App\Livewire;

use App\Models\Package;
use Livewire\Component;

class TryoutOnline extends Component
{

    public $package;
    public $questions;
    public $currentPackageQuestion;

    function mount($id) {
        $this->package = Package::with("questions.question.options")->find($id);

        if ($this->package) {
            $this->questions = $this->package->questions;

            if ($this->questions->isNotEmpty()) {
                $this->currentPackageQuestion = $this->questions->first();
            }
        }

    }
    public function render()
    {
        return view('livewire.tryout');
    }

    function goToQuestion($package_question_id) {
        $this->currentPackageQuestion = $this->questions->where('id', $package_question_id)->first();
    }

    protected function calculatedTimeLest() {

    }

    function saveAnswer($questionId, $optionId) {
        
    }
}
