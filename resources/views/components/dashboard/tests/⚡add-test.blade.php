<?php

use App\Actions\Dashboard\CreateExamAction;
use App\Actions\Dashboard\UpdateExamAction;
use App\Http\Requests\AddTestRequest;
use App\Models\Exam;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $title;
    public $description;
    public $duration;
    public $passing_score;
    public $status = 1;
    public $start_at;
    public $end_at;
    public string $mode = 'create';
    public $exam;
    public $id;

    public function rules()
    {
        return [
            'title' => ['required','string','max:40',Rule::unique('exams', 'title')->ignore($this->exam?->id)],
            'description' => 'required|string|max:255',
            'passing_score' => 'required|numeric|min:0|max:20',
            'duration' => 'required|numeric|min:1',
            'status' => 'required|in:0,1',
            'start_at' => 'date|after:now',
            'end_at' => 'date|after:start_at',
        ];
    }

    public function messages(): array
    {
        return [

            'title.required' => 'عنوان آزمون الزامی است.',
            'title.string' => 'عنوان آزمون باید متن باشد.',
            'title.max' => 'عنوان آزمون نباید بیشتر از ۴۰ کاراکتر باشد.',
            'title.unique' => 'این عنوان قبلاً ثبت شده است.',

            'description.required' => 'توضیحات آزمون الزامی است.',
            'description.string' => 'توضیحات باید متن باشد.',
            'description.max' => 'توضیحات نباید بیشتر از ۲۵۵ کاراکتر باشد.',

            'passing_score.required' => 'نمره قبولی الزامی است.',
            'passing_score.numeric' => 'نمره قبولی باید عدد باشد.',
            'passing_score.min' => 'نمره قبولی نمی‌تواند کمتر از ۰ باشد.',
            'passing_score.max' => 'نمره قبولی نمی‌تواند بیشتر از ۲۰ باشد.',

            'duration.required' => 'مدت زمان آزمون الزامی است.',
            'duration.numeric' => 'مدت زمان آزمون باید عدد باشد.',
            'duration.min' => 'مدت زمان آزمون باید حداقل ۱ دقیقه باشد.',

            'status.required' => 'وضعیت آزمون را انتخاب کنید.',
            'status.boolean' => 'وضعیت آزمون معتبر نیست.',

            'start_at.required' => 'زمان شروع آزمون الزامی است.',
            'start_at.date' => 'زمان شروع معتبر نیست.',
            'start_at.after' => 'زمان شروع باید بعد از زمان فعلی باشد.',

            'end_at.required' => 'زمان پایان آزمون الزامی است.',
            'end_at.date' => 'زمان پایان معتبر نیست.',
            'end_at.after' => 'زمان پایان باید بعد از زمان شروع باشد.',

        ];
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    #[On('exam-edit')]
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);

        $this->mode = 'edit';

        $this->id = $id;
        $this->exam = $exam;
        $this->title = $exam->title;
        $this->description = $exam->description;
        $this->duration = $exam->duration;
        $this->passing_score = $exam->passing_score;
        $this->status = $exam->status ? '1' : '0';

        $this->start_at = optional($exam->start_at)?->format('Y-m-d\TH:i');
        $this->end_at = optional($exam->end_at)?->format('Y-m-d\TH:i');

        $this->dispatch('show-modal');
    }

    public function save(CreateExamAction $createExamAction, UpdateExamAction $updateExamAction): void
    {
        $this->validate();

        if ($this->mode === 'create') {
            $createExamAction->execute($this->title, $this->description, $this->duration,
                $this->status, $this->passing_score, $this->start_at, $this->end_at);
            $this->dispatch('create-exam');
        } else {
            $updateExamAction->execute($this->id, $this->title, $this->description, $this->duration,
                $this->passing_score, $this->start_at, $this->end_at, $this->status);
            session()->flash('success', 'با موفقیت ویرایش شد');
            $this->dispatch('edit-exam');
            $this->redirectRoute('dashboard.tests.list',navigate: true);
        }

        $this->reset();
        $this->dispatch('close-modal');
    }
};
?>

<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-show="test" x-transition
     x-on:close-modal.window="test=false" x-on:show-modal.window="test = true">

    <div :class="dark ? 'bg-gray-900' : 'bg-white'"
         class="w-full max-w-2xl h-[80%] rounded-xl shadow-lg p-8 overflow-y-auto">

        <h2 class="text-2xl font-bold text-center mb-8">
            {{ $this->mode === 'create' ? 'ایجاد آزمون جدید' : 'ویرایش آزمون' }}
        </h2>

        <form wire:submit="save" class="space-y-5">


            <div>
                <label class="block mb-2 font-medium">
                    عنوان آزمون
                </label>

                <input
                    type="text" wire:model.live.blur="title"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                @error('title')
                <span class="text-sm text-red-600" wire:text="$errors.first('title')"></span>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    توضیحات
                </label>

                <textarea
                    rows="5" wire:model.live.blur="description"
                    class="w-full border rounded-lg px-4 py-2 resize-none outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                @error('description')
                <span class="text-sm text-red-600" wire:text="$errors.first('description')"></span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 font-medium">
                        مدت آزمون (دقیقه)
                    </label>

                    <input
                        type="number" wire:model.live.blur="duration"
                        class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    @error('duration')
                    <span class="text-sm text-red-600" wire:text="$errors.first('duration')"></span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        نمره قبولی
                    </label>

                    <input
                        type="number" wire:model.live.blur="passing_score"
                        class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    @error('passing_score')
                    <span class="text-sm text-red-600" wire:text="$errors.first('passing_score')"></span>
                    @enderror
                </div>

            </div>

            <div>
                <label class="block mb-2 font-medium">
                    وضعیت
                </label>

                <select wire:model.live.blur="status"
                        class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="1">فعال</option>
                    <option value="0">غیرفعال</option>

                </select>
                @error('status')
                <span class="text-sm text-red-600" wire:text="$errors.first('status')"></span>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    زمان شروع
                </label>

                <input
                    type="datetime-local" wire:model.live.blur="start_at"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                @error('start_at')
                <span class="text-sm text-red-600" wire:text="$errors.first('start_at')"></span>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    زمان پایان
                </label>

                <input
                    type="datetime-local" wire:model.live.blur="end_at"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                @error('end_at')
                <span class="text-sm text-red-600" wire:text="$errors.first('end_at')"></span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white rounded-lg py-3 hover:bg-blue-700 transition">

                {{ $mode === 'create' ? 'ایجاد آزمون' : 'ویرایش آزمون' }}

            </button>
            <button x-on:click="test=false" type="button"
                    class="w-full bg-red-600 text-white rounded-lg py-3 hover:bg-red-700 transition">

                بستن

            </button>

        </form>

    </div>

</div>
