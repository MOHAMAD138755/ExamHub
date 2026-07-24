<?php

use App\Actions\Dashboard\UpdateQuestionAction;
use App\Models\Question;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public $question;
    public $score;
    public $correct_option;
    public $options = [];
    public Question $questionModel;

    #[On('question-edit')]
    public function edit($id)
    {
        $this->questionModel = Question::with('options')->findOrFail($id);

        $this->question = $this->questionModel->question_text;
        $this->score = $this->questionModel->score;

        $this->correct_option = $this->questionModel->options
            ->search(fn ($option) => $option->is_correct);

        $this->options = $this->questionModel->options
            ->pluck('option_text')
            ->toArray();

        $this->dispatch('show-question-modal');
    }

    public function rules(): array
    {
        return [

            'question' => ['required', 'string', 'max:5000'],

            'score' => ['required', 'integer', 'min:1'],

            'correct_option' => ['required', 'integer', 'between:0,3'],

            'options' => ['required', 'array', 'size:4'],

            'options.*' => ['required', 'string', 'max:255', 'distinct'],

        ];
    }

    public function messages(): array
    {
        return [

            'question.required' => 'متن سوال الزامی است.',

            'score.required' => 'نمره سوال را وارد کنید.',

            'correct_option.required' => 'پاسخ صحیح را انتخاب کنید.',

            'options.required' => 'گزینه‌ها الزامی هستند.',

            'options.size' => 'باید دقیقا ۴ گزینه وارد کنید.',

            'options.*.required' => 'تمام گزینه‌ها باید پر شوند.',

            'options.*.distinct' => 'گزینه‌ها نباید تکراری باشند.',

        ];
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function update(UpdateQuestionAction $updateQuestionAction)
    {
        $this->validate();

        $updateQuestionAction->execute(
            $this->questionModel,
            $this->question,
            $this->score,
            $this->options,
            $this->correct_option
        );

        session()->flash('success', 'با موفقیت ویرایش شد.');

        $this->dispatch('close-question-modal');
    }
};
?>

<div x-on:show-question-modal.window="showQuestionModal=true" x-on:close-question-modal.window="showQuestionModal=false"
     x-show="showQuestionModal"
     x-transition
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
>
    <div :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'"
         class="w-full max-w-3xl rounded-xl  p-6 shadow-xl"
    >

        <form wire:submit="update"
              class="space-y-5">

            <div>

                <label class="block mb-2 font-medium">
                    متن سوال
                </label>

                <textarea
                        wire:model.live.blur="question"
                        rows="3"
                        class="w-full rounded-lg border-gray-300 border-2"></textarea>
                @error('question')
                <span class="text-sm text-red-600" wire:text="$errors.first('question')"></span>
                @enderror

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block mb-2 font-medium">
                        نمره
                    </label>

                    <input
                            type="number"
                            wire:model.live.blur="score"
                            class="w-full rounded-lg border-gray-300 border-2">
                    @error('score')
                    <span class="text-sm text-red-600" wire:text="$errors.first('score')"></span>
                    @enderror

                </div>

            </div>

            @for($i = 0; $i < 4; $i++)

                <div class="flex items-center gap-3">

                    <input
                            type="radio"
                            wire:model.live.blur="correct_option"
                            value="{{ $i }}">
                    @error('correct_option')
                    <span class="text-sm text-red-600" wire:text="$errors.first('correct_option')"></span>
                    @enderror

                    <input
                            type="text"
                            wire:model.live.blur="options.{{ $i }}"
                            placeholder="گزینه {{ $i+1 }}"
                            class="flex-1 rounded-lg border-gray-300 border-2">

                    @error("options.$i")
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror

                </div>

            @endfor

            <button type="submit"
                    class="px-5 py-2 bg-green-600  rounded-lg hover:bg-green-700">

                ویرایش

            </button>

            <button @click="showQuestionModal=false" type="button"
                    class="px-5 py-2 bg-red-600  rounded-lg hover:bg-red-700">

                بستن

            </button>

            @if(session()->has('success'))
                <p class="text-center text-green-600 p-4">{{ session('success') }}</p>
            @endif

        </form>

    </div>
</div>
