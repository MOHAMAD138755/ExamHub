<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

new #[Title('آزمون آنلاین')] #[Layout("layouts.home")] class extends Component {
    //
};
?>
<div class="dark:text-white dark:bg-black">
    <div class="w-full py-5 flex justify-center items-center flex-col-reverse md:flex-row">
        <div class="flex justify-center items-center flex-col mx-10">
            <div class="flex flex-col">
                <h2 class="md:text-4xl lg:text-right text-center text-2xl mb-10 md:font-extrabold font-bold">تجربه‌ی
                    زندگی راحت‌تر، سریع‌تر و <br>به‌صرفه‌تر با سوپراپلیکیشن اسنپ!</h2>
                <p class="text-gray-500">از درخواست خودرو تا سفارش غذا، خرید سوپرمارکتی، رزرو بلیت سفر و... را با اسنپ
                    انجام دهید.</p>
            </div>
            <div class="flex items-end justify-end gap-4 mt-8">
                <button
                    class="md:px-6 px-2 md:py-3 py-2 dark:shadow-white cursor-pointer hover:shadow-2xl transition-all text-white bg-[#21aa58] rounded-md"
                    type="button">ورود به وب اپلیکیشن
                </button>
                <button id="btn"
                        class="relative overflow-hidden md:px-6 px-2 md:py-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-400 transition-all text-[#21aa58] dark:text-green-700 border border-[#21aa58] rounded-md"
                        type="button">دانلود برنامه
                </button>
            </div>
        </div>
        <div>
            <img class="md:h-[299px] md:w-[440px] h-[150px] w-[200px]"
                 src="{{ asset('storage/logo/newheroimage.png') }}" alt="logo">
        </div>
    </div>
    <div class="w-[80%] m-auto md:bg-white dark:bg-black bg-gray-50  my-3">
        <h3 class="text-gray-700 dark:text-white text-xl">یک اپلیکیشن، برای تمام نیازها</h3>
        <div
            class="inline-flex flex-col  flex-wrap p-4 my-5 md:mx-2 md:px-5 px-7 cursor-pointer md:border-none border mr-1  border-gray-300 dark:bg-gray-800 bg-white rounded-sm dark:hover:text-gray-800  md:hover:bg-gray-100 md:rounded-xl md:transition-all md:duration-200">
            <img class="w-[64px]  h-[64px]"
                 src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/parvaz-dakheli.png" alt="logo">
            <p class="md:font-medium text-sm">گردشگری</p>
        </div>
        <div
            class="inline-flex flex-col  flex-wrap p-4 my-5 md:mx-2 md:px-5 px-7 cursor-pointer md:border-none border mr-1  border-gray-300  dark:bg-gray-800 bg-white rounded-sm dark:hover:text-gray-800 md:hover:bg-gray-100 md:rounded-xl md:transition-all md:duration-200">
            <img class="w-[64px]  h-[64px]"
                 src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/parvaz-dakheli.png" alt="logo">
            <p class="md:font-medium text-sm">گردشگری</p>
        </div>
        <div
            class="inline-flex flex-col  flex-wrap p-4 my-5 md:mx-2 md:px-5 px-7 mr-1 cursor-pointer md:border-none border border-gray-300 dark:bg-gray-800 bg-white rounded-sm dark:hover:text-gray-800  md:hover:bg-gray-100 md:rounded-xl md:transition-all md:duration-200">
            <img class="w-[64px]  h-[64px]"
                 src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/parvaz-dakheli.png" alt="logo">
            <p class="md:font-medium text-sm">گردشگری</p>
        </div>
        <div
            class="inline-flex flex-col  flex-wrap p-4 my-5 md:mx-2 md:px-5 px-7 mr-1 cursor-pointer md:border-none border border-gray-300 dark:bg-gray-800 bg-white rounded-sm dark:hover:text-gray-800  md:hover:bg-gray-100 md:rounded-xl md:transition-all md:duration-200">
            <img class="w-[64px]  h-[64px]"
                 src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/parvaz-dakheli.png" alt="logo">
            <p class="md:font-medium text-sm">گردشگری</p>
        </div>
        <div
            class="inline-flex flex-col  flex-wrap p-4 my-5 md:mx-2 md:px-5 px-7 mr-1 cursor-pointer md:border-none border border-gray-300 dark:bg-gray-800 bg-white rounded-sm dark:hover:text-gray-800  md:hover:bg-gray-100 md:rounded-xl md:transition-all md:duration-200">
            <img class="w-[64px]  h-[64px]"
                 src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/parvaz-dakheli.png" alt="logo">
            <p class="md:font-medium text-sm">گردشگری</p>
        </div>
        <div class="flex flex-wrap md:justify-start justify-center">
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
            <div
                class="lg:w-[30%] md:w-[35%] w-full m-5 flex justify-between dark:bg-gray-900 bg-[#f8f9ff] px-3 py-2 rounded-md cursor-pointer">
                <div class="md:text-base text-sm">
                    <p>تاکسی اینترنتی</p>
                    <p class="text-gray-700 dark:text-white">درخواست آنلاین خودرو</p>
                </div>
                <img class="w-[60px] h-[60px]"
                     src="https://web-cdn.snapp.ir/snappir-marketing/images/new-intros/bimeh.png" alt="logo">
            </div>
        </div>
        <div id="slider" class="my-2 flex relative overflow-hidden rounded-lg">
            <div id="track" class="flex transition-transform duration-500 ease-out">
                <img class="rounded-lg shrink-0 w-full"
                     src="https://web-cdn.snapp.ir/snappir-marketing//images/pay/investment.webp" alt="">
                <img class="rounded-lg shrink-0 w-full"
                     src="https://web-cdn.snapp.ir/snapp-website/images/homepage/slider/Market.jpg"
                     alt="">
                <img class="rounded-lg shrink-0 w-full"
                     src="https://web-cdn.snapp.ir/snappir-marketing//images/taxi/taxidiscountslider.jpg" alt="">
            </div>
            <button id="next"
                    class="hidden md:block absolute bottom-[30px] right-5 cursor-pointer bg-gray-400 rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                     class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                </svg>
            </button>
            <button id="ago"
                    class="hidden md:block absolute bottom-[30px] right-20 cursor-pointer bg-gray-400 rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                     class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="w-full bg-[#eeefff] my-7 dark:bg-gray-800">
        <div class="w-[80%] mx-auto">
            <div class="text-center ">
                <h2 class="md:text-3xl text-2xl py-5 font-bold">در کمتر از ۱۰ دقیقه ثبت‌نام کنید و به ناوگان اسنپ
                    بپیوندید.</h2>
                <p class="md:text-xl text-lg">بدون نیاز به مراجعه‌ی حضوری، از طریق این صفحه، تمام مراحل ثبت‌نام را
                    اینترنتی انجام دهید</p>
                <button class="my-5 px-5 py-2 bg-[#21aa58] cursor-pointer text-white rounded-md">ثبت نام رانندگان
                </button>
            </div>
            <div class="my-5">
                <video class="rounded-lg" controls
                       src="https://web-cdn.snapp.ir/snappir-marketing/images/homepage/jazbranandeh1.mp4"></video>
            </div>
            <div class="flex flex-wrap justify-center">
                <div class="bg-white dark:bg-gray-900 rounded-lg md:w-[45%] w-[90%] px-5 py-10 m-3">
                    <img class="mx-auto" src="https://web-cdn.snapp.ir/snapp-website/images/homepage/180x100-income.png"
                         alt="logo">
                    <h4 class="md:text-lg text-base py-2 font-bold">درآمد تضمینی + پاداش‌های ماهانه و هفتگی</h4>
                    <p class="text-gray-600 dark:text-white md:text-[15px] text-[14px]">با فعالیت در ناوگان اسنپ، علاوه
                        بر کسب درآمد
                        مستمر و امکان تسویه در لحظه می‌توانید با شرکت در طرح‌های تشویقی مختلف، درآمد خود را افزایش
                        دهید.</p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg md:w-[45%] w-[90%] px-5 py-10 m-3">
                    <img class="mx-auto" src="https://web-cdn.snapp.ir/snapp-website/images/homepage/180x100-income.png"
                         alt="logo">
                    <h4 class="md:text-lg text-base py-2 font-bold">درآمد تضمینی + پاداش‌های ماهانه و هفتگی</h4>
                    <p class="text-gray-600 dark:text-white md:text-[15px] text-[14px]">با فعالیت در ناوگان اسنپ، علاوه
                        بر کسب درآمد
                        مستمر و امکان تسویه در لحظه می‌توانید با شرکت در طرح‌های تشویقی مختلف، درآمد خود را افزایش
                        دهید.</p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg md:w-[45%] w-[90%] px-5 py-10 m-3">
                    <img class="mx-auto" src="https://web-cdn.snapp.ir/snapp-website/images/homepage/180x100-income.png"
                         alt="logo">
                    <h4 class="md:text-lg text-base py-2 font-bold">درآمد تضمینی + پاداش‌های ماهانه و هفتگی</h4>
                    <p class="text-gray-600 dark:text-white md:text-[15px] text-[14px]">با فعالیت در ناوگان اسنپ، علاوه
                        بر کسب درآمد
                        مستمر و امکان تسویه در لحظه می‌توانید با شرکت در طرح‌های تشویقی مختلف، درآمد خود را افزایش
                        دهید.</p>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg md:w-[45%] w-[90%] px-5 py-10 m-3">
                    <img class="mx-auto" src="https://web-cdn.snapp.ir/snapp-website/images/homepage/180x100-income.png"
                         alt="logo">
                    <h4 class="md:text-lg text-base py-2 font-bold">درآمد تضمینی + پاداش‌های ماهانه و هفتگی</h4>
                    <p class="text-gray-600 dark:text-white md:text-[15px] text-[14px]">با فعالیت در ناوگان اسنپ، علاوه
                        بر کسب درآمد
                        مستمر و امکان تسویه در لحظه می‌توانید با شرکت در طرح‌های تشویقی مختلف، درآمد خود را افزایش
                        دهید.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script type="text/javascript">
    (function () {
            let nextBtn = document.querySelector('#next')
            let agoBtn = document.querySelector('#ago')
            const track = document.getElementById('track')
            let images = track.querySelectorAll('img')
            let currentIndex = 0
            const totalImage = images.length
            let startX = 0
            let btn = document.getElementById('btn')

        function update() {
            track.style.transform = `translateX(${currentIndex * 100}%)`
        }

        nextBtn.addEventListener('click', nextClick)

        function nextClick() {
            currentIndex = (currentIndex + 1) % totalImage
            update()
        }

        agoBtn.addEventListener('click', function () {
            currentIndex = (currentIndex - 1 + totalImage) % totalImage
            update()
        })

        track.addEventListener('touchstart', function (event) {
            startX = event.touches[0].clientX
        })

        track.addEventListener('touchend', function (event) {
            let endX = event.changedTouches[0].clientX
            let diff = startX - endX

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    currentIndex = (currentIndex + 1) % totalImage
                } else {
                    currentIndex = (currentIndex - 1 + totalImage) % totalImage
                }
            }
            update()
        })

        btn.addEventListener('click', function (event) {
            let x = event.clientX - event.target.offsetLeft
            let y = event.clientY - event.target.offsetTop

            let tag = document.createElement('span')
            tag.classList.add('w-[50px]', 'absolute', 'h-[50px]', 'bg-gray-100', 'rounded-full', 'pointer-events-none', 'transform',
                '-translate-x-1/2',
                '-translate-y-1/2', 'animate-ping')
            btn.classList.add('hover:text-green-900')
            tag.style.left = x + 'px'
            tag.style.top = y + 'px'
            this.appendChild(tag)

            setTimeout(function () {
                tag.remove()
            }, 500)
        })

        setInterval(nextClick, 3000)
    })()
</script>
@endscript
