<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body
    x-data="{ loading:true ,dark : localStorage.getItem('dark') === 'true'}"

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

    class="flex justify-center item-center min-h-screen  transitions-colors duration-500"

    :class="dark ? 'bg-gray-900 text-white' : 'bg-white text-black'"

>

<div :class="dark ? 'bg-gray-900' : 'bg-white'" x-show="loading" class="fixed inset-0 z-50 flex justify-center items-center" x-transition:leave.duration.700ms>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading"></div>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading2"></div>
    <div class="size-5 bg-[#a1a3a8] rounded-full mx-1 loading3"></div>
</div>

{{ $slot }}


@livewireScripts
</body>
</html>
