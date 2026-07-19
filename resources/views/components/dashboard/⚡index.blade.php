<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::dashboard')] #[Title('داشبورد ادمین')] class extends Component {
    //
};
?>

<div>
    <h1 class="text-center text-2xl font-bold">صفحه اصلی</h1>
    <div class="flex justify-center items-center my-10 flex-wrap">
        <div class="w-[250px] h-[100px] rounded-[10px] shadow-2xl border-r-[6px] border-r-green-700  mx-5 my-5 hover:shadow-2xs hover:translate-y-[-10px] transition-all">
            <div class="flex justify-center items-center gap-5  h-[90px]"  :class="dark ? 'text-white' : 'text-gray-700'">
                <i class="fa-solid fa-users p-1"></i>
                <h3 class=" text-lg font-semibold">تعداد کاربران</h3>
                <p class="font-bold text-lg p-1">10000</p>
            </div>
        </div>
        <div class="w-[250px] h-[100px] rounded-[10px] shadow-2xl   border-r-[6px] border-r-red-600 mx-5 my-5 hover:shadow-2xs hover:translate-y-[-10px] transition-all">
            <div class="flex justify-center items-center gap-5  h-[90px]"    :class="dark ? 'text-white' : 'text-gray-700'">
                <i class="fa-solid fa-solid fa-list-check p-1"></i>
                <h3 class=" text-lg font-semibold">بانک سوالات</h3>
                <p class="font-bold text-lg p-1">10000</p>
            </div>
        </div>
        <div class="w-[250px] h-[100px] rounded-[10px] shadow-2xl   border-r-[6px] border-r-yellow-400 mx-5 my-5 hover:shadow-2xs hover:translate-y-[-10px] transition-all">
            <div class="flex justify-center items-center gap-5  h-[90px]"    :class="dark ? 'text-white' : 'text-gray-700'">
                <i class="fa-solid fa-file-circle-question p-1"></i>
                <h3 class="text-lg font-semibold">تعداد آزمون ها</h3>
                <p class="font-bold text-lg p-1">10000</p>
            </div>
        </div>
        <div class="w-[260px] h-[100px] rounded-[10px] shadow-2xl  border-r-[6px] border-r-blue-700 mx-5 my-5 hover:shadow-2xs hover:translate-y-[-10px] transition-all">
            <div class="flex justify-center items-center gap-5  h-[90px]"    :class="dark ? 'text-white' : 'text-gray-700'">
                <i class="fa-solid fa-play p-1"></i>
                <h3 class=" text-lg font-semibold">آزمون های فعال</h3>
                <p class="font-bold text-lg p-1">10000</p>
            </div>
        </div>
    </div>

    <div class="w-full flex flex-wrap justify-around items-center">

        <div class="my-10">
            <h2 class="font-semibold p-2 text-lg text-right">آخرین فعالیت ها</h2>
            <hr class="border-2 w-[250px] border-yellow-300">
            <div class="flex">
                <i class="fa-solid fa-user-plus p-5 text-green-400"></i>
            <p class="p-3 italic">کاربر جدید ثبت نام کرد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-file-circle-plus p-5 text-blue-400"></i>
            <p class="p-3 italic">آزمون php ایجاد شد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-trash p-5 text-red-400"></i>
            <p class="p-3 italic">آزمون حذف شد</p>
            </div>
        </div>

        <div class="my-10">
            <h2 class="font-semibold p-2 text-lg text-right">آخرین کاربران </h2>
            <hr class="border-2 w-[250px] border-b-violet-700">
            <div class="flex">
                <i class="fa-solid fa-right-to-bracket p-5 text-green-400"></i>
                <p class="p-3 italic">کاربر جدید ثبت نام کرد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-right-from-bracket p-5 text-blue-400"></i>
                <p class="p-3 italic">آزمون php ایجاد شد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-circle-question p-5 text-red-400"></i>
                <p class="p-3 italic">آزمون حذف شد</p>
            </div>
        </div>

        <div class="my-10">
            <h2 class="font-semibold p-2 text-lg text-right">آخرین آزمون ها </h2>
            <hr class="border-2 w-[250px] border-b-blue-500">
            <div class="flex">
                <i class="fa-solid fa-right-to-bracket p-5 text-green-400"></i>
                <p class="p-3 italic">کاربر جدید ثبت نام کرد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-right-from-bracket p-5 text-blue-400"></i>
                <p class="p-3 italic">آزمون php ایجاد شد</p>
            </div>
            <div class="flex">
                <i class="fa-solid fa-circle-question p-5 text-red-400"></i>
                <p class="p-3 italic">آزمون حذف شد</p>
            </div>
        </div>

    </div>

</div>

