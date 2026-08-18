<?php

use App\Models\Question;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard')] #[Title('بانک سوالات')] class extends Component {
    use WithPagination, WithoutUrlPagination;
    public $search;

    #[Computed]
    public function questions()
    {
        return Question::query()->when($this->search, function ($query) {
            $query->where('question_text', 'like', "%{$this->search}%")
                ->Orwhere('score', $this->search, "%{$this->search}%");
        })->with('exam')->latest()->paginate(7);
    }

    public function delete($id)
    {
        Question::where('id', $id)->delete();
        session()->flash('success', 'با موفقیت حذف شد');
    }
};
?>

<div class=" rounded-xl shadow p-6">

    <h2 class="text-xl font-bold mb-5">
        لیست سوالات
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
                    برای آزمون
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
                        {{ $question->exam->title ?? 'در آزمونی نیست' }}
                    </td>

                    <td class="py-3">
                        {{ $question->score }}
                    </td>

                    <td class="py-3 text-center">

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

        {{ $this->questions->links() }}

        @if(session()->has('success'))
            <p class="text-center text-green-600 p-4">{{ session('success') }}</p>
        @endif

    </div>

</div>
