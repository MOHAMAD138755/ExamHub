<?php

use App\Actions\Dashboard\SearchUserAction;
use App\Actions\Dashboard\UserDeleteAction;
use App\Actions\Dashboard\UserListAction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Layout('layouts::dashboard')] #[Title('لیست کاربران')] class extends Component {

    use WithPagination, WithoutUrlPagination;

    public $searchItem = '';

    #[Computed]
    public function users()
    {
        return app(UserListAction::class)->execute($this->searchItem);
    }

    public function delete($user_id)
    {
        app(UserDeleteAction::class)->execute($user_id);

        session()->flash('success', 'با موفقیت حذف شد');
        $this->resetPage();
    }
};
?>
<div class="flex justify-center flex-col items-center h-[80%]"
     :class="dark ? 'text-white'"
>

    <h1 class="text-3xl pb-[40px]">لیست کاربران سایت</h1>

    <div class="relative w-[350px] my-[40px]">

        <input wire:model.live.debounce.100ms="searchItem"
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

    <table class="w-full table-auto md:table-fixed border-collapse">
        <thead>
        <tr>
            <th class="border-b border-gray-200 p-4 pt-0 pb-3 pl-8 text-center font-medium">آیدی</th>
            <th class="border-b border-gray-200 p-4 pt-0 pb-3 text-center font-medium">نام کاربر</th>
            <th class="border-b border-gray-200 p-4 pt-0 pr-8 pb-3 text-center font-medium">ایمیل</th>
            <th class="border-b border-gray-200 p-4 pt-0 pr-8 pb-3 text-center font-medium">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($this->users as $user)
            <tr>
                <td class="border-b border-gray-100 p-4 pr-8 pb-3 pt-3 text-center">{{ $user->id }}</td>
                <td class="border-b border-gray-100 p-4 pr-8 pb-3 pt-3 text-center">{{ $user->name ?? 'نامی انتخاب نکرده' }}</td>
                <td class="border-b border-gray-100 p-4 pr-8 pb-3 pt-3 text-center">{{ $user->email }}</td>
                <td class="border-b border-gray-100 p-4 pr-8 pb-3 pt-3 text-center">
                    <button wire:click="delete({{ $user->id }})"
                            class="size-[40px] transition-all hover:bg-red-500 cursor-pointer bg-red-600 rounded-lg">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-4">
                    کاربری یافت نشد
                </td>
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
    <br>
    {{ $this->users->links() }}
</div>
