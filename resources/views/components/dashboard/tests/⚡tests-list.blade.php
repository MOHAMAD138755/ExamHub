<?php

use App\Models\Exam;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard')] #[Title('لیست آزمون ها')] class extends Component {
    use WithPagination, WithoutUrlPagination;

    public $search;

    #[Computed]
    public function exams()
    {
        return Exam::query()->when($this->search, function ($query) {
            $query->where('title', 'like', "%{$this->search}%")
                ->orwhere('description', 'like', "%{$this->search}%")
                ->orwhere('status', 'like', "%{$this->search}%");
        })->latest()
            ->paginate(7);
    }

    #[On('create-exam')]
    #[On('edit-exam')]
    public function refreshExam()
    {

    }

    public function deleteExam($id)
    {
        Exam::findOrFail($id)->delete();

        session()->flash('success', 'با موفقیت حذف شد');
        $this->resetPage();
    }
};
?>

<div :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'" class="rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold">
            لیست آزمون‌ها
        </h2>

        <div class="relative w-[350px]">

            <input wire:model.live.debounce.100ms="search"
                   type="text"
                   placeholder="جستجوی آزمون..."
                   class="w-full border border-gray-300 rounded-lg pr-10 pl-4 py-2 outline-none
               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>

            </svg>

        </div>

        <a @click="test=true"
           class="bg-blue-600 px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition">

            ایجاد آزمون

        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full border border-gray-200">

            <thead>

            <tr>

                <th class="p-3 text-center">#</th>

                <th class="p-3 text-center">عنوان</th>

                <th class="p-3 text-center">مدت</th>

                <th class="p-3 text-center">قبولی</th>

                <th class="p-3 text-center">شروع</th>

                <th class="p-3 text-center">پایان</th>

                <th class="p-3 text-center">وضعیت</th>

                <th class="p-3 text-center">عملیات</th>

            </tr>

            </thead>

            <tbody>

            @forelse($this->exams as $exam)
                <tr class="border-t">

                    <td class="p-3 text-center">
                        {{ $exam->id }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $exam->title }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $exam->duration }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $exam->passing_score }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $exam->start_at }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $exam->end_at }}
                    </td>

                    <td class="p-3 text-center">

                    <span @class(['px-3 py-1 rounded-full text-xs','bg-green-500' => $exam->status==1,'bg-red-500' => $exam->status==0])>
                        {{ $exam->status == 1 ? 'فعال' : 'غیر فعال'}}
                    </span>

                    </td>

                    <td class="p-3">

                        <div class="flex justify-center gap-2">

                            <button
                                wire:click="$dispatchTo('dashboard.tests.add-test', 'exam-edit', { id: @js($exam->id) })"
                                class="bg-yellow-500  px-3 py-1 rounded hover:bg-yellow-600">

                                <i class="fa-solid fa-pen-to-square"></i>

                            </button>

                            <button wire:click="deleteExam({{ $exam->id }})"
                                    class="bg-red-500  px-3 py-1 rounded hover:bg-red-600">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                            <a wire:navigate href="{{ route('dashboard.questions.list',['exam'=>$exam->id]) }}">
                            <button
                                    class="bg-green-500  px-3 py-1 rounded hover:bg-green-600">

                                <i class="fa-solid fa-square-plus"></i>

                            </button>
                            </a>
                        </div>

                    </td>

                </tr>
            @empty
                <tr>
                    <td class="text-center p-4 text-red-500">آزمونی وجود ندارد</td>
                </tr>
            @endforelse

            </tbody>

            <tfoot>
            @if(session()->has('success'))
                <tr>
                    <td colspan="4" class="text-center text-green-600 p-4">{{ session('success') }}</td>
                </tr>
            @endif
            </tfoot>

        </table>

        {{ $this->exams->links() }}

    </div>

</div>
