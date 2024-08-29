<div>
    <style>
        .active-question{
            border : 2px solid darkblue;
        }

        .no-hover:hover{
            background-color: transparent !important;
            color: inherit !important;
        }

        .disable-radio{
            cursor: not-allowed;
        }

        .disable-button{
            pointer-events: none;
            opacity: .6;
        }
    </style>
    <div class="container">
        <div class="row">
            <h4>{{ $package->name }}</h4>
            <div class="col-md-8">
                <div id="question-container">
                    <div class="card question-card">

                        @if ($tryout->finished_at === null)
                        <div class="countdown-timer mb-4 text-success" id="countdown">
                            Waktu Tersisa : <span id="time"></span>
                        </div>
                        @endif

                        <div class="card-body">
                            <p class="card-text">{{ $currentPackageQuestion->question->question }}</p>
                            @foreach ($currentPackageQuestion->question->options as $item)
                            <div class="form-check">
                                <input
                                    wire:model="selectedAnswers.{{ $currentPackageQuestion->question_id }}"
                                    wire:click="saveAnswer({{ $currentPackageQuestion->question_id }}, {{ $item->id }})"
                                    class="form-check-input"
                                    type="radio"
                                    @if ($timeLeft <= 0)
                                        disabled
                                        class="disable-radio"
                                    @endif
                                    name="question"
                                    value={{ $item->id }}
                                    @if ($tryoutAnswers->isNotEmpty() || $tryoutAnswers->contains('question_option_id', $item->id))
                                        checked
                                    @endif
                                    >
                                <label class="form-check-label">{{ $item->option_text }}</label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card question-navigation">
                    <div class="card-body">
                        <h5 class="card-title">Navigasi</h5>
                        <div class="btn-group-flex" role="group">
                            @foreach ($questions as $index => $item)
                            @php
                                $isAnswered = isset($selectedAnswers[$item->question_id]) && !is_null($selectedAnswers[$item->question_id]);
                                $isActive = $currentPackageQuestion->question->id === $item->question_id;
                            @endphp
                            <div class="col-2 mb-2">
                                <button
                                type="button"
                                @if ($timeLeft <= 0)
                                    disabled
                                @endif
                                wire:click="goToQuestion('{{ $item->id }}')"
                                class="btn
                                    {{ $isAnswered ? 'btn-primary' : 'btn-outline-primary no-hover' }}
                                    {{ $isActive ? 'active-question' : '' }}
                                ">
                                {{ $index+1 }}
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" wire:click="submit" onclick="return confirm('Apakah anda yakin ingin mengirim jawaban ini?')" class="btn btn-primary mt-3 w-100">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        @if (session()->has("message"))
            <div class="alert alert-success text-center">
                {{ session('message') }} <a href="">Lihat Hasil Pengerjaan</a>
            </div>
        @endif
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            let timeLeft = {{ $timeLeft }}
            startCountDown(timeLeft, document.querySelector("#time"))
        })

        function startCountDown(duration, display) {
            let timer = duration, minutes, seconds
            setInterval(function() {
                hours = parseInt(timer / 3600, 10)
                minutes = parseInt((timer % 3600) / 60, 10)
                seconds = parseInt(timer % 60, 10)

                hours = hours < 10 ? "0" + hours : hours
                minutes = minutes < 10 ? "0" + minutes : minutes
                seconds = seconds < 10 ? "0" + seconds : seconds

                display.textContent = `${hours} : ${minutes} : ${seconds}`

                if (--timer < 0) {
                    timer = 0
                }
            }, 1000);

        }
    </script>
</div>
