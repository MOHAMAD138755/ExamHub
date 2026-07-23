<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-show="test" x-transition>

    <div :class="dark ? 'bg-gray-900' : 'bg-white'" class="w-full max-w-2xl h-[80%] rounded-xl shadow-lg p-8 overflow-y-auto">

        <h2 class="text-2xl font-bold text-center mb-8">
            ایجاد آزمون جدید
        </h2>

        <form class="space-y-5">


            <div>
                <label class="block mb-2 font-medium">
                    عنوان آزمون
                </label>

                <input
                    type="text"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    توضیحات
                </label>

                <textarea
                    rows="5"
                    class="w-full border rounded-lg px-4 py-2 resize-none outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 font-medium">
                        مدت آزمون (دقیقه)
                    </label>

                    <input
                        type="number"
                        class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        نمره قبولی
                    </label>

                    <input
                        type="number"
                        class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>

            <div>
                <label class="block mb-2 font-medium">
                    وضعیت
                </label>

                <select
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">

                    <option>فعال</option>
                    <option>غیرفعال</option>

                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    زمان شروع
                </label>

                <input
                    type="datetime-local"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    زمان پایان
                </label>

                <input
                    type="datetime-local"
                    class="w-full border rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white rounded-lg py-3 hover:bg-blue-700 transition">

                ایجاد آزمون

            </button>
            <button x-on:click="test=false" type="button"
                class="w-full bg-red-600 text-white rounded-lg py-3 hover:bg-red-700 transition">

                بستن

            </button>

        </form>

    </div>

</div>
