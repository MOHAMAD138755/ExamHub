<?php

use App\Models\Exam;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard')] #[Title('لیست آزمون ها')] class extends Component {
    use WithPagination, WithoutUrlPagination;

    #[Computed]
    public function exams()
    {
        return Exam::latest()->paginate(7);
    }

    public function deleteExam($id)
    {
        Exam::findOrFail($id)->delete();

        session()->flash('success','با موفقیت حذف شد');
        $this->resetPage();
    }
};
?>

<div :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'" class="rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold">
            لیست آزمون‌ها
        </h2>

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
                        {{ $exam->status }}
                    </span>

                    </td>

                    <td class="p-3">

                        <div class="flex justify-center gap-2">

                            <button
                                class="bg-yellow-500  px-3 py-1 rounded hover:bg-yellow-600">

                                ویرایش

                            </button>

                            <button wire:click="deleteExam({{ $exam->id }})"
                                class="bg-red-500  px-3 py-1 rounded hover:bg-red-600">

                                حذف

                            </button>

                        </div>

                    </td>

                </tr>
            @empty
                <tr>
                    <td class="text-center p-4"></td>
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
