<div>
    <div class="container">
        <div class="row">
            <h4>{{ $package->name }}</h4>
            <div class="col-md-8">
                <div id="question-container">
                    <div class="card question-card">

                        <div class="countdown-timer mb-4 text-success" id="countdown">
                            Waktu Tersisa : <span id="time"></span>
                        </div>

                        <div class="card-body">
                            <p class="card-text">{{ $currentPackageQuestion->question->question }}</p>
                            @foreach ($currentPackageQuestion->question->options as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question" value="">
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
                                <button type="button" wire:click="goToQuestion('{{ $item->id }}')" class="btn btn-outline-primary">{{ $index+1 }}</button>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary mt-3 w-100">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

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

        window.addEventListener("load",function () {
            console.log("asu");
            const duration = 60 * 60
            const display = document.querySelector("#time")
            startCountDown(duration, display)
        })
    </script>
</div>
