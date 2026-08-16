<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="dark:bg-black select-none">
<div id="loading"
     class="fixed inset-0 z-[100] flex justify-center items-center dark:bg-black bg-white opacity-100 transition-opacity duration-1000 ease-in-out">
    <div class="size-5 bg-green-500 rounded-full mx-1 loading"></div>
    <div class="size-5 bg-green-500 rounded-full mx-1 loading2"></div>
    <div class="size-5 bg-green-500 rounded-full mx-1 loading3"></div>
</div>
<div class="w-full dark:bg-black dark:dark:text-white">
    <div class="flex md:hidden justify-between w-full flex-nowrap">
        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" id="hamber_menu"
             class="bi bi-list mr-4 mt-3 transition-all text-green-700 hover:bg-gray-200 hover:rounded-sm cursor-pointer"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
        <img class="ml-4 mt-3" src="{{ asset('storage/logo/snappTextLogo.svg') }}" alt="logo">
    </div>
    <div class="w-full hidden md:flex h-[80px] items-center justify-start mt-2">
        <img class="lg:mr-20 mr-5  w-17 h-17 lg:w-23 lg:h-23" src="{{ asset('storage/logo/snappTextLogo.svg') }}"
             alt="logo">
        <ul class="flex justify-start items-center lg:gap-8 gap-5 lg:text-[15px] text-xs dark:text-white text-gray-700 whitespace-nowrap">
            <li class="pr-5 relative group transition-all cursor-default">
                        <span class="flex items-center gap-1 py-3">آزمون ها
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class=" w-4 h-4 transition-transform group-hover:rotate-180 font-bold mt-2 mx-1 bi bi-chevron-down"
                             viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                            </span>
                <ul class="hidden absolute top-full z-[100] border border-gray-200 group-hover:block w-[150px] dark:bg-black  bg-white shadow-2xl rounded-md cursor-pointer">
                    @auth
                    <li class="py-3 px-2 hover:text-green-400 transition-all"><a wire:navigate href="{{ route('exams.list') }}">همه ی آزمون ها</a></li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all"><a wire:navigate href="{{ route('exams.my-exams') }}">آزمون های من</a></li>
                    @endauth
                        <li class="py-3 px-2 cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('home') }}">صفحه اصلی</a>
                        </li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all">سوپرمارکت آنلاین</li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all">درخواست تاکسی</li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all">پیک موتوری</li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all">سفارش آنلاین غذا</li>
                    <li class="py-3 px-2 hover:text-green-400 transition-all">سوپرمارکت آنلاین</li>
                </ul>
            </li>
            @guest
            <li class=" cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('login') }}">ثبت نام و ورود</a></li>
            @endguest
            @auth
            <li class=" cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('user_logout') }}">خروج</a></li>
            @endauth
            @if(auth()->user()->is_admin == 1)
            <li class=" cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('dashboard.index') }}">پنل مدیریت</a></li>
            @endif
            <li class=" cursor-pointer hover:text-green-400 transition-all">باشگاه رانندگان</li>
            <li class=" cursor-pointer hover:text-green-400 transition-all mode">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                     class="bi bi-moon-stars-fill moon" viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                    <path
                        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                     class="bi bi-brightness-high hidden sun" viewBox="0 0 16 16">
                    <path
                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                </svg>
            </li>
        </ul>
    </div>
</div>
<div id="toggle" class="fixed inset-0 z-[100] hidden text-md select-none">
    <div class="w-[60%] dark:bg-gray-900 dark:text-white bg-white backdrop-blur-lg shadow-2xl border-l border-gray-200 z-50">
        <svg id="close" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-x w-8 h-8 mx-4 my-2 cursor-pointer" viewBox="0 0 16 16">
            <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        </svg>
        <ul class="flex flex-col">
            <li class="border-b border-gray-100">
                <div id="open-box-menu"
                     class="flex justify-between items-center p-4 cursor-pointer dark:hover:bg-gray-500 hover:bg-gray-50 transition-all">
                    <span class="font-medium dark:text-white text-gray-800">سوپراپ اسنپ</span>
                    <svg id="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="ml-5 w-4 h-4 bi bi-chevron-down transition-transform duration-300"
                         viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                    </svg>
                </div>
                <ul id="show-box" class="hidden">
                    @auth
                        <li class="mr-5 my-3  hover:text-green-400 transition-all"><a wire:navigate href="{{ route('exams.list') }}">همه ی آزمون ها</a></li>
                        <li class="mr-5 my-3  hover:text-green-400 transition-all"><a wire:navigate href="{{ route('exams.my-exams') }}">آزمون های من</a></li>
                    @endauth
                    <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('home') }}">صفحه اصلی</a>
                    </li>
                    <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all">رزرو بلیط قطار</li>
                </ul>
            </li>
            @guest
                <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('login') }}">ثبت نام و ورود</a></li>
            @endguest
            @auth
                <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('user_logout') }}">خروج</a></li>
            @endauth
            @if(auth()->user()->is_admin == 1)
                <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all"><a wire:navigate href="{{ route('dashboard.index') }}">پنل مدیریت</a></li>
            @endif
            <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all">باشگاه رانندگان</li>
            <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all">پنل سازمانی</li>
            <li class="mr-5 my-3 cursor-pointer hover:text-green-400 transition-all">باشگاه رانندگان</li>
            <li class="mr-10 my-3 cursor-pointer hover:text-green-400 transition-all mode">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-moon-stars-fill moon" viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                    <path
                        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-brightness-high hidden sun" viewBox="0 0 16 16">
                    <path
                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                </svg>
            </li>
        </ul>
    </div>
    <div class="w-[40%] bg-gray-300/80 backdrop-blur-sm flex items-center justify-center text-gray-600"></div>
</div>
{{ $slot }}
<div class="w-full my-10 flex flex-col justify-center items-center">
    <ul class="flex items-center justify-center flex-wrap">
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">فرصت‌های شغلی</li>
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">بلاگ</li>
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">پنل سازمانی</li>
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">سوالات متداول</li>
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">ثبت نام راننده اسنپ</li>
        <li class="lg:px-5 px-2 text-gray-700 dark:text-white py-3 cursor-pointer">کد تخفیف اسنپ</li>
    </ul>
    <div class="my-3 flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter-x text-gray-900 dark:text-white mx-3 cursor-pointer" viewBox="0 0 16 16">
            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram text-gray-900 dark:text-white mx-3 cursor-pointer" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook text-gray-900 dark:text-white mx-3 cursor-pointer" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-youtube text-gray-900 dark:text-white mx-3 cursor-pointer" viewBox="0 0 16 16">
            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
        </svg>
    </div>
    <div class="flex my-5">
        <img class="mx-5" src="https://ecunion.ir/bundles/pouyasoft/home/img/namad.png" alt="logo">
        <img class="mx-5" src="https://ecunion.ir/bundles/pouyasoft/home/img/namad.png" alt="logo">
    </div>
</div>
@livewireScripts
<script type="text/javascript">
    (function () {
        let hamber = document.getElementById('hamber_menu')
        let toggle = document.getElementById('toggle')
        let close = document.getElementById('close')
        let open = document.getElementById('open-box-menu')
        let show_box = document.getElementById('show-box')
        let icon = document.getElementById('icon')

        hamber.addEventListener('click', function () {
            if (toggle.classList.contains('hidden')) {
                toggle.classList.remove('hidden')
                toggle.classList.add('flex')
            } else {
                toggle.classList.remove('flex')
                toggle.classList.add('hidden')
            }
        })

        close.addEventListener('click', function () {
            toggle.classList.remove('flex')
            toggle.classList.add('hidden')
        })

        open.addEventListener('click', function () {
            if (show_box.classList.contains('hidden')) {
                show_box.classList.remove('hidden')
                show_box.classList.add('block')
                icon.classList.add('rotate-180')
            } else {
                show_box.classList.remove('block')
                show_box.classList.add('hidden')
                icon.classList.remove('rotate-180')
                icon.classList.add('rotate-0')
            }
        })

        const loading = document.getElementById('loading')

        if (loading) {
            setTimeout(() => {
                loading.classList.remove('opacity-100')
                loading.classList.add('opacity-0')

                setTimeout(() => {
                    loading.classList.remove('flex')
                    loading.classList.add('hidden')
                }, 1000)
            }, 2000)
        }

        let moons = document.querySelectorAll('.moon')
        let suns = document.querySelectorAll('.sun')

        function updateIcon(isDark) {
            moons.forEach(
                (moon)=>{
                    moon.classList.toggle('hidden',!isDark)
                    moon.classList.toggle('block',isDark)
                }
            )
            suns.forEach(
                (sun)=>{
                    sun.classList.toggle('hidden',isDark)
                    sun.classList.toggle('block',!isDark)
                }
            )
        }

        let isDark = localStorage.getItem('theme') === "dark"
        document.documentElement.classList.toggle('dark',isDark)

        function ChangeMode() {
            isDark = !document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateIcon(isDark)
        }
        document.querySelectorAll('.mode').forEach((item)=>{
            item.addEventListener('click',ChangeMode)
        })

    })()
</script>
</body>
</html>
