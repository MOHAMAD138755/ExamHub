<?php

use App\Models\Exam;
use App\Models\Question;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public Exam $exam;
    public $answers = [];
    public $currentIndex = 0;

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $examUser = auth()->user()
            ->exams()
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        if ($examUser->pivot->started_at === null) {
            auth()->user()->exams()->updateExistingPivot($exam->id, [
                'started_at' => now(),
            ]);
        }

        if($examUser->pivot->submitted_at !== null){
            $this->redirectRoute('exams.my-exams', navigate: true);
            return;
        }
    }

    #[Computed]
    public function remainingSeconds()
    {
        $examUser = auth()->user()
            ->exams()
            ->where('exam_id', $this->exam->id)
            ->firstOrFail();
        $started_at = \Carbon\Carbon::parse($examUser->pivot->started_at);
        $endTime = $started_at
            ->copy()
            ->addMinutes($this->exam->duration);

        return max(0, (int)now()->diffInSeconds($endTime, false));
    }

    #[Computed]
    public function questions()
    {
        $exam_id = Exam::where('slug', $this->exam->slug)->get()[0]->id;
        return Question::with('options')->where('exam_id', $exam_id)->get();
    }

    public function selectAnswer($question_id, $option_id)
    {
        $this->answers[$question_id] = $option_id;
    }

    public function submitExam()
    {
        $examUser = auth()->user()
            ->exams()
            ->where('exam_id', $this->exam->id)
            ->firstOrFail();
        $started_at = \Carbon\Carbon::parse($examUser->pivot->started_at);
        $endTime = $started_at
            ->copy()
            ->addMinutes($this->exam->duration);
        $timeIsUp = now()->greaterThanOrEqualTo($endTime);

        if ($examUser->pivot->submitted_at !== null) {
            return;
        }

        $correct = 0;
        foreach ($this->questions as $question) {
            if (
                isset($this->answers[$question->id]) &&
                $question->options
                    ->where('id', $this->answers[$question->id])
                    ->where('is_correct', 1)
                    ->isNotEmpty()
            ) {
                $correct += $question->score;
            }
        }
//        $total = $this->questions->count();
        $totalScore = $this->questions->sum('score');

        $score = $totalScore > 0
            ? ($correct / $totalScore) * 20
            : 0;

        auth()->user()
            ->exams()
            ->updateExistingPivot($this->exam->id, [
                'score' => round($score,2),
                'submitted_at' => now()
            ]);

        $this->redirectRoute('exams.my-exams', navigate: true);
    }

    public function next()
    {
        $questions = $this->questions[$this->currentIndex];
        if(!isset($this->answers[$questions->id])){
            return;
        }
        if ($this->currentIndex < $this->questions()->count() - 1) {
            $this->currentIndex++;
        }
    }

    public function previous()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }
};
?>
<div class="flex  items-center flex-col flex-wrap w-[80%] min-h-screen mx-auto justify-center select-none">
    <div class="flex flex-row-reverse text-lg">
    <h2 class="mx-2"> :نام آزمون</h2>
    <p>{{ $this->exam->title }}</p>
    </div>
    <div  wire:ignore id="timer" class="my-2 text-2xl"></div>
    @if($this->questions->isNotEmpty())
        @php
            $question = $this->questions[$this->currentIndex];
        @endphp
        <div
            class="bg-white shadow-2xl rounded-lg lg:w-[40%] md:w-[65%] w-[100%]  dark:bg-gray-800 p-5 text-center mx-auto lg:my-4 my-1">

                <h2 class="text-lg font-bold">
                    سوال:{{ $this->currentIndex + 1 }}
                </h2>

                <h2 class="text-lg font-bold">
                    {{ $question->question_text }}
                </h2>

                <div class="space-y-3">

                    @foreach($question->options as $option)
                        <label class="flex cursor-pointer items-center gap-3 rounded-lg border p-3 border-gray-300 font-bold">

                            <input wire:key="question_{{ $question->id }}_option_{{ $option->id }}"
                                   type="radio"
                                   name="question_{{ $question->id }}"
                                   value="{{ $option->id }}"
                                   wire:click="selectAnswer({{ $question->id }},{{ $option->id }})"
                                @checked(
                                isset($this->answers[$question->id])
                                   && $this->answers[$question->id] == $option->id)
                            >

                            <span>
                        {{ $option->option_text }}
                    </span>

                        </label>

                    @endforeach
                    <p>تعداد سوالات: {{ $this->questions->count() }}</p>
                        <p>تعداد سوالات پاسخ داده شده: {{ count($this->answers) }}</p>
                </div>

            <div class="flex justify-center items-center w-[100%] my-2">
                <button
                    @disabled($this->currentIndex === 0) class="rounded-lg mx-2 border-[1px] border-red-500 w-[40%] py-2  text-red-600 transition-all hover:bg-red-700 hover:text-white  cursor-pointer"
                    wire:click="previous">سوال قبلی
                </button>
                @if($this->currentIndex < $this->questions->count() - 1)
                    @if(isset($this->answers[$question->id]))
                    <button class="mx-2 rounded-lg  border-[1px] border-green-500  w-[40%] py-2 text-green-600 transition-all hover:bg-green-700 hover:text-white cursor-pointer"
                            wire:click="next">سوال بعدی
                    </button>
                    @endif
                @endif
            </div>
        </div>
        <button
            wire:click="submitExam"
            class="mx-2 lg:my-5 my-2 rounded-lg  border-[1px] border-green-500 lg:w-[40%] md:w-[65%] w-[100%] py-2 text-green-600 transition-all hover:bg-green-700 hover:text-white hover:border-none cursor-pointer"
        >
            ثبت آزمون
        </button>
    @else
        <p>سوالی وجود ندارد</p>
    @endif
</div>
@script
<script type="text/javascript">
    let timer = document.getElementById('timer')
    let timeSeconds = {{ $this->remainingSeconds }};

    const showTimer = setInterval(function () {
        let min = Math.floor((timeSeconds % 3600) / 60);
        let seconds = timeSeconds % 60;
        let hour = Math.floor(timeSeconds / 3600);

        timer.innerHTML = `${String(hour).padStart(2, '0')}:${String(min).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`

        if (timeSeconds <= 0) {
            clearInterval(showTimer);
            $wire.submitExam();
        }

        if (timeSeconds <= 60) {
            timer.classList.add('text-red-500')
        }

        timeSeconds--;

    }, 1000)

</script>
@endscript
