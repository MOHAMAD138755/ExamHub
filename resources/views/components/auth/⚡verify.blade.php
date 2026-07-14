<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component {
    //
};
?>

<div class="flex justify-center items-center flex-col overflow-hidden">

    <div class="w-auto h-auto border-0  rounded-lg lg:border lg:border-gray-200">

        <div class="flex justify-center items-center">
            <i class="fa fa-arrow-right my-10 ml-30"></i>
            <img class="size-[70px] my-5 ml-30" src="{{ asset('storage/logo/logo.jpg') }}" alt="">
        </div>

        <h3 class="font-semibold text-xl mx-10 my-5">کد تایید رو وارد کنید</h3>

        <p class="text-gray-500 text-sm mx-10">کد تایید به شماره موبایل <span class="font-extrabold underline"
                                                                              :class="dark ? 'text-white' : 'text-black'">09907393873</span>
            ارسال شد.</p>
        <p class="text-gray-500 text-sm mx-10">لطفا کد 6 رقمی را وارد کنید.</p>

        <div class="flex justify-center items-center w-full">
            <form class="w-full px-10">

                <div class="relative w-full my-5 xl:w-full lg:w-[650px] md:w-[720px] sm:w-[610px]">
                    <input autofocus class="text-center text-xl border-gray-300 border-3 border rounded-sm w-full h-11 px-4 text-sm
                    outline-none transition-all focus:border-blue-500" type="text" placeholder=" ">
                </div>

                <button class="mb-5 w-full h-[50px] bg-[#ef4056] rounded-lg text-white cursor-pointer hover:bg-linear-to-r from-indigo-500 via-purple-500 to-pink-500
                 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 " type="submit">
                    تایید
                </button>
            </form>
        </div>

    </div>

</div>
