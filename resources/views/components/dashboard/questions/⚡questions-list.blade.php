<?php

use App\Actions\Dashboard\CreateQuestionAction;
use App\Actions\Dashboard\QuestionListAction;
use App\Models\Exam;
use App\Models\Question;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::dashboard')] #[Title('افزودن سوال')] class extends Component {
    public Exam $exam;
    public string $question = '';
    public int $score = 1;
    public ?int $correct_option = null;
    public array $options = ['', '', '', '',];

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

    public function save(CreateQuestionAction $createQuestionAction)
    {
        $this->validate();
        $createQuestionAction->execute($this->question, $this->exam->id, $this->score,
            $this->options, $this->correct_option);
        session()->flash('success', 'با موفقیت اضافه شد');

        $this->reset([
            'question',
            'score',
            'correct_option',
            'options',
        ]);

        $this->score = 1;

        $this->options = ['', '', '', ''];
    }

    #[Computed]
    public function questions()
    {
        return resolve(QuestionListAction::class)
            ->execute($this->exam->id);
    }

    public function delete($id)
    {
        Question::where('id', $id)->delete();
        session()->flash('success', 'با موفقیت حذف شد');
    }

    #[On('close-question-modal')]
    public function refreshQuestion()
    {

    }
};
?>
<div class="space-y-6" :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'">
    @livewire('dashboard.questions.edit-question')
    <h2 class="text-center text-2xl">عنوان آزمون: {{ $this->exam->title }}</h2>

    <div class=" rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">
            افزودن سوال
        </h2>

        <form wire:submit="save"
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

                ثبت سوال

            </button>

            <a wire:navigate href="{{ route('dashboard.tests.list') }}">
                <button type="button"
                        class="px-5 py-2 bg-red-600  rounded-lg hover:bg-red-700">

                    برگشتن

                </button>
            </a>

            @if(session()->has('success'))
                <p class="text-center text-green-600 p-4">{{ session('success') }}</p>
            @endif

        </form>

    </div>


    <div class=" rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">
            لیست سوالات
        </h2>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                <tr class="border-b">

                    <th class="text-right py-3">
                        #
                    </th>

                    <th class="text-right py-3">
                        سوال
                    </th>


                    <th class="text-right py-3">
                        نمره
                    </th>

                    <th class="text-center py-3">
                        عملیات
                    </th>

                </tr>

                </thead>

                <tbody x-data="{ question:false }">

                @forelse($this->questions as $question)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $question->id }}
                        </td>

                        <td class="py-3">
                            {{ $question->question_text }}
                        </td>

                        <td class="py-3">
                            {{ $question->score }}
                        </td>

                        <td class="py-3 text-center">

                            <button
                                wire:click="$dispatchTo('dashboard.questions.edit-question', 'question-edit', { id: @js($question->id) })"
                                class="text-yellow-500 hover:text-yellow-600">

                                <i class="fa-solid fa-pen"></i>

                            </button>

                            <button wire:click="delete({{ $question->id }})"
                                    class="text-red-500 hover:text-red-600 ms-3">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center py-5 ">

                            سوالی ثبت نشده است.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
