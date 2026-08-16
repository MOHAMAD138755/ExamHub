<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Title('آزمون های من')] #[Layout("layouts.home")] class extends Component {
    use WithPagination, WithoutUrlPagination;

    #[Computed]
    public function exams()
    {
        return auth()->user()->exams()->where('exams.start_at', '<', now())
            ->where('exams.end_at', '>', now())->paginate(2);
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
                <button
                    class="w-full bg-green-700 rounded-md text-white cursor-pointer p-2 relative btn overflow-hidden italic">
                    شرکت در آزمون
                </button>
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
    (function () {
        document.addEventListener('click', function (event) {
            let button = event.target.closest('.btn');
            let x = event.clientX - event.target.offsetLeft
            let y = event.clientY - event.target.offsetTop

            let tag = document.createElement('span')
            tag.classList.add('w-[50px]', 'absolute', 'h-[50px]', 'bg-gray-100', 'rounded-full', 'pointer-events-none', 'transform',
                '-translate-x-1/2',
                '-translate-y-1/2', 'animate-ping')
            button.classList.add('hover:text-white')
            tag.style.left = x + 'px'
            tag.style.top = y + 'px'
            button.appendChild(tag)

            setTimeout(function () {
                tag.remove()
            }, 500)
        })
    })()
</script>
@endscript
