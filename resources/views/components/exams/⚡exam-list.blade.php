<?php

use App\Actions\Home\CreateExamUserAction;
use App\Models\Exam;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Title('همه ی آزمون ها')] #[Layout("layouts.home")] class extends Component {
    use WithPagination, WithoutUrlPagination;
    public $registerdExam = [];

    #[Computed]
    public function exams()
    {
        return Exam::where('start_at', '<', now())
            ->where('end_at', '>', now())->paginate(2);
    }

    #[On('createExamUser')]
    public function mount()
    {
        $this->registerdExam = auth()->user()->exams()->pluck('exams.id')->toArray();
    }

    public function createExam(CreateExamUserAction $createExamUserAction, $exam_id)
    {
        $createExamUserAction->execute($exam_id, auth()->id());
        $this->dispatch('createExamUser');
    }
};
?>

<div class="flex  items-center flex-wrap w-[80%] mx-auto justify-center  dark:text-white">
    @forelse($this->exams as $exam)
        <div
            class="bg-white shadow-2xl rounded-lg lg:w-[40%] md:w-[65%] w-[100%]  dark:bg-gray-800 p-5 text-center break-normal md:break-all mx-5 my-4">
            <h3 class="text-xl py-1">نام آزمون: {{ $exam->title }}</h3>
            <p class="py-2">زمان شروع: {{ $exam->start_at }}</p>
            <p class="py-2">زمان پایان: {{ $exam->end_at }}</p>
            <p class="py-2">وضعیت آزمون: {{ $exam->status == 1 ? "فعال است" : "غیر فعال" }}</p>
            <p class="py-2">توضیحات: {{ $exam->description }}</p>
            <p class="py-2">نمره قبولی: {{ $exam->passing_score }}</p>
            @auth
                @if(!in_array($exam->id,$this->registerdExam))
                    <button wire:click="createExam({{ $exam->id }})"
                            class="w-full bg-green-700 rounded-md text-white cursor-pointer p-2 relative btn overflow-hidden italic">
                        ثبت نام
                    </button>
                @else
                    <button
                        class="w-full bg-green-800 rounded-md text-white cursor-not-allowed p-2 relative btn overflow-hidden italic">
                        ثبت نام کردید
                    </button>
                @endif
            @endauth
            @guest
                <button
                    class="w-full bg-red-700 rounded-md text-white cursor-pointer p-2 relative btn overflow-hidden italic">
                    در سایت ورود کنید
                </button>
            @endguest
        </div>
    @empty
        <p>آزمونی وجود ندارد</p>
    @endforelse
    {{ $this->exams->links() }}
</div>
@script
<script type="text/javascript">
    const btn = document.querySelectorAll('.btn')
    btn.forEach(function (button) {
        button.addEventListener('click', function (event) {
            let x = event.clientX - event.target.offsetLeft
            let y = event.clientY - event.target.offsetTop

            let tag = document.createElement('span')
            tag.classList.add('w-[50px]', 'absolute', 'h-[50px]', 'bg-gray-100', 'rounded-full', 'pointer-events-none', 'transform',
                '-translate-x-1/2',
                '-translate-y-1/2', 'animate-ping')
            button.classList.add('hover:text-white')
            tag.style.left = x + 'px'
            tag.style.top = y + 'px'
            this.appendChild(tag)

            setTimeout(function () {
                tag.remove()
            }, 500)
        })
    })
</script>
@endscript
