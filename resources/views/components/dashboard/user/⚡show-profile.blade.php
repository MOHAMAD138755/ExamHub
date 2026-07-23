<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function user()
    {
        return auth()->user();
    }

    #[On('profile-updated')]
    public function refreshProfile()
    {
        $this->user = auth()->user()->fresh();
    }
};
?>

<div>
    <div class="size-[90px] m-auto py-5 rounded-full">
        <img class="rounded-full bg-cover" src="{{ \Illuminate\Support\Facades\Storage::url($this->user->image) ??
           asset('storage/logo/images.png') }}" alt="profile">
    </div>
    <h3 class="text-center pb-2">{{ $this->user->name ?? 'ادمین' }}</h3>
    <button x-on:click="modal=true"
            class="w-[120px] h-[35px] text-white bg-green-700 rounded-[5px] block mx-auto mb-[10px] cursor-pointer">
        ویرایش پروفایل
    </button>
</div>
