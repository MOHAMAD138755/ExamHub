<?php

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $name;
    public $email;
    public $image;

    public function mount(): void
    {
        $user = auth()->user();

        $this->name = $user->name ?? 'ادمین';
        $this->email = $user->email;
    }

    public function rules(): array
    {
        return (new UpdateProfileRequest())->rules();
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام اجباری است',
            'name.max' => 'حداکثر 15 کاراکتر',
            'email.required' => 'ایمیل اجباری است',
            'email.email' => 'باید از نوع ایمیل باشد',
            'image.max' => 'حجم فایل نهایتا 2 مگابایت',
            'image.mimes' => 'فرمت های مجازjpeg,png,jpg'

        ];
    }

    public function updateUser()
    {
        $this->validate();
        $user = auth()->user();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->image) {

            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = $this->image->store('profile', 'public');
        }

        $user->update($data);
        $this->dispatch('profile-updated');
    }
};
?>

<div
    x-show="modal" x-on:profile-updated.window="modal = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    x-transition
>
    <div class="bg-white text-black p-6 rounded-lg w-[500px]">

        <h2 class="text-center text-lg">ویرایش پروفایل</h2>

        <form wire:submit="updateUser" class="flex justify-center items-center flex-col">
            <input type="text" class="w-full my-2 outline-0 border-1 border-gray-400 rounded-sm" wire:model.live.blur="name">
            <div class="p-[5px] text-center" wire:show="$errors.has('name')">
                @error('name')
                <span class="text-sm text-red-600" wire:text="$errors.first('name')"></span>
                @enderror
            </div>
            <input type="text" class="w-full my-2 outline-0 border-1 border-gray-400 rounded-sm" wire:model.live.blur="email">
            <div class="p-[5px] text-center" wire:show="$errors.has('email')">
                @error('email')
                <span class="text-sm text-red-600" wire:text="$errors.first('email')"></span>
                @enderror
            </div>
            <input type="file" class="w-full my-2 outline-0 border-1 border-gray-400 rounded-sm" wire:model.live.blur="image">
            <div class="p-[5px] text-center" wire:show="$errors.has('image')">
                @error('image')
                <span class="text-sm text-red-600" wire:text="$errors.first('image')"></span>
                @enderror
            </div>
            @if($this->image)
                <p wire:loading>uploading...</p>
                <img src="{{ $this->image->temporaryUrl() }}" alt="" class="size-[35px]">
            @endif
            <button type="submit" class="w-full my-2 h-[25px] bg-green-500 text-white rounded-sm cursor-pointer">
                ویرایش
            </button>
        </form>

        <button class="w-full my-2 h-[25px] bg-red-500 text-white rounded-sm cursor-pointer" @click="modal = false">
            بستن
        </button>

    </div>
</div>
