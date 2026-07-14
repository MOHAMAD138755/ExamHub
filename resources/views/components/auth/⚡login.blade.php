<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component {
    public function next()
    {
        $this->redirectRoute('verify',navigate: true);
    }
};
?>

<div class="flex justify-center items-center flex-col overflow-hidden">

    <div class="w-auto h-100 border-0  rounded-lg lg:border lg:border-gray-200">

        <div class="flex justify-center items-center">
            <i class="fa fa-arrow-right my-10 ml-30"></i>
            <img class="size-[70px] my-5 ml-30" src="{{ asset('storage/logo/logo.jpg') }}" alt="">
        </div>

        <h3 class="font-semibold mx-10 my-5">ورود یا ثبت‌نام</h3>

        <p class="text-gray-500 text-sm mx-10">لطفا ایمیل خود را وارد کنید</p>

        <div class="flex justify-center items-center w-full">
            <form class="w-full px-10" wire:submit="next">

                <div class="relative w-full my-5 xl:w-full lg:w-[650px] md:w-[720px] sm:w-[610px]">
                    <input class="peer border-gray-300 border rounded-sm w-full h-11 px-4 text-sm
                    outline-none transition-all focus:border-blue-500" type="text"  placeholder=" ">
                    <span class="absolute right-4 top-3 text-gray-400 text-sm  px-1  transition-all duration-200 peer-focus:-top-2
                    peer-focus:text-xs
                    peer-focus:text-blue-500 peer-not-placeholder-shown:-top-4 peer-not-placeholder-shown:text-xs"
                          :class="dark ? 'bg-gray-900' : 'bg-white'"
                    >پست الکترونیک</span>
                </div>

                <button class="w-full h-[50px] bg-[#ef4056] rounded-lg text-white cursor-pointer hover:bg-linear-to-r from-indigo-500 via-purple-500 to-pink-500
                 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 " type="submit">
                    ورود به سایت
                </button>
            </form>
        </div>

        <div class="w-full flex my-5 mx-5 md:mx-10">
            <button x-on:click="dark=!dark" class="w-[120px] h-[35px] bg-blue-700 text-white rounded-lg mx-20
             cursor-pointer hover:bg-blue-950 transition-all">تغییر رنگ</button>
        </div>

    </div>

</div>
