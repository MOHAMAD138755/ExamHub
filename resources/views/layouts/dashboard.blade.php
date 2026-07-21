<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body x-data="{ loading:true ,dark : localStorage.getItem('dark') === 'true',open:false}"

      x-init="setTimeout(() => loading = false, 2000);

        if(dark){
        document.documentElement.classList.add('dark')
    }

    $watch('dark', value => {
        localStorage.setItem('dark', value)

        if(value){
            document.documentElement.classList.add('dark')
        }else{
            document.documentElement.classList.remove('dark')
        }
    })
        "

      class="flex justify-center items-center min-h-screen  transitions-colors duration-500 bg-gray-300"

      :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'"



>

<div :class="dark ? 'bg-gray-900' : 'bg-white'" x-show="loading" class="fixed inset-0 z-50 flex justify-center items-center" x-transition:leave.duration.700ms>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading"></div>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading2"></div>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading3"></div>
</div>

<div class="flex h-screen w-full overflow-hidden" >

    <div class="w-[20%] overflow-y-auto overflow-x-hidden h-screen  text-white lg:block hidden" :class="dark ? 'bg-black' : 'bg-gray-900'">
        <div class="size-[70px] m-auto my-4 rounded-full"><img class="rounded-full bg-cover" src="{{ asset('storage/logo/images.png') }}" alt=""></div>
        <h3 class="text-center p-2">رضا محمدی</h3>
        <button class="w-[120px] h-[35px] text-white bg-green-700 rounded-[5px] block mx-auto mb-[10px] cursor-pointer">ویرایش پروفایل</button>
        <button x-on:click="dark=!dark" class="block mx-auto text-xl font-bold cursor-pointer">
        <i :class="dark ? 'fa-solid fa-moon' : 'fa-solid fa-sun'" class="p-1"></i>
        </button>
        <hr class="border border-b-gray-400 opacity-10">
        <div class="w-full">
            <ul class="flex flex-col gap-2 px-4 py-4 cursor-pointer">

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('dashboard.index') ? 'bg-blue-600 text-white' : '' }}">
                    <i class="fa-solid fa-gauge-high text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <a wire:navigate href="{{ route('dashboard.index') }}">داشبورد</a>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">

                    <i class="fa-solid fa-users text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>کاربران</span>
                </li>

                <li class="rounded-xl {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}" x-data="{ open: @js(request()->routeIs('')) }">

                    <button
                        @click="open = !open"
                        class="group flex items-center justify-between w-full rounded-xl px-4 py-3
        transition-all duration-300 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600">

                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-circle-question"></i>
                            <span>آزمون‌ها</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <ul
                        x-show="open"
                        x-transition
                        class="mr-8 mt-2 space-y-2">

                        <li class="rounded-lg px-3 py-2 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">
                            <i class="fa-solid fa-table-list"></i>
                            لیست آزمون‌ها
                        </li>

                        <li class="rounded-lg px-3 py-2 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">
                            <i class="fa-solid fa-circle-plus"></i>
                            ایجاد آزمون
                        </li>

                    </ul>

                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-list-check text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>بانک سوالات</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-square-poll-vertical text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>نتایج</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-chart-line text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>تحلیل‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-clock-rotate-left text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>گزارش فعالیت‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-bell text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>اعلان‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-gear text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>تنظیمات</span>
                </li>

                @livewire('auth.logout')

            </ul>
        </div>
    </div >

    <div x-show="open"  x-transition class="w-[100%] overflow-y-auto overflow-x-hidden text-white text-[12px]  md:text-[17px] lg:hidden md:block sm:block"  :class="dark ? 'bg-black' : 'bg-gray-900'">
        <div class="size-[70px] m-auto my-4 rounded-full"><img class="rounded-full bg-cover" src="{{ asset('storage/logo/images.png') }}" alt=""></div>
        <h3 class="text-center p-2">رضا محمدی</h3>
        <button class="w-[120px] h-[35px] text-white bg-green-700 rounded-[5px] block mx-auto mb-[10px] cursor-pointer">ویرایش پروفایل</button>
        <button x-on:click="dark=!dark" class="block mx-auto text-xl font-bold cursor-pointer">
            <i :class="dark ? 'fa-solid fa-moon' : 'fa-solid fa-sun'" class="p-1"></i>
        </button>
        <hr class="border border-b-gray-400 opacity-10">
        <div class="w-full">
            <ul class="flex flex-col gap-2 px-4 py-4 cursor-pointer">

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('dashboard.index') ? 'bg-blue-600 text-white' : '' }}">
                    <i class="fa-solid fa-gauge-high text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <a wire:navigate href="{{ route('dashboard.index') }}">داشبورد</a>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">

                    <i class="fa-solid fa-users text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>کاربران</span>
                </li>

                <li class="rounded-xl {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}" x-data="{ open: @js(request()->routeIs('')) }">

                    <button
                        @click="open = !open"
                        class="group flex items-center justify-between w-full rounded-xl px-4 py-3
        transition-all duration-300 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600">

                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-circle-question"></i>
                            <span>آزمون‌ها</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 p-2"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <ul
                        x-show="open"
                        x-transition
                        class="mr-8 mt-2 space-y-2">

                        <li class="rounded-lg px-3 py-2 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">
                            <i class="fa-solid fa-table-list"></i>
                            لیست آزمون‌ها
                        </li>

                        <li class="rounded-lg px-3 py-2 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">
                            <i class="fa-solid fa-circle-plus"></i>
                            ایجاد آزمون
                        </li>

                    </ul>

                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-list-check text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>بانک سوالات</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-square-poll-vertical text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>نتایج</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-chart-line text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>تحلیل‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-clock-rotate-left text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>گزارش فعالیت‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-bell text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>اعلان‌ها</span>
                </li>

                <li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg {{ request()->routeIs('') ? 'bg-blue-600 text-white' : '' }}">

                    <i class="fa-solid fa-gear text-gray-500 transition-all duration-300 group-hover:text-white"></i>
                    <span>تنظیمات</span>
                </li>

                @livewire('auth.logout')

            </ul>
        </div>
    </div>

    <button
        class="lg:hidden block p-4"
        x-on:click="open=!open"
    >
        <i class="fa-solid fa-bars text-2xl"></i>
    </button>

    <div class="w-[80%] h-[650px]  scrollbar-none overflow-auto hid rounded-[5px] shadow-2xl m-10">{{ $slot }}</div>

</div>


@livewireScripts
</body>
</html>
