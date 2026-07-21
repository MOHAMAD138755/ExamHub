<?php

use App\Actions\Auth\ResendCodeUserAction;
use App\Actions\Auth\VerifyUserAction;
use App\Http\Requests\VerifyRequest;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::auth')] #[Title('تایید کد ورود')] class extends Component {

    public string $email;
    public $expires_at;
    public $code;

    public function rules(): array
    {
        return (new VerifyRequest())->rules();
    }

    public function updated($property): void
    {
        $this->validateOnly($property);
    }

    public function messages(): array
    {
        return [
            'code.required' => 'وارد کردن کد اجباری است',
            'code.digits' => 'کد وارد شده باشد شش رقم و عدد باشد'
        ];
    }

    public function mount()
    {
        $this->email = session('login_email');

        $otp = OtpCode::where('user_id', session('user_id'))->latest()->first();

        $this->expires_at = $otp->expires_at->getTimestampMs();
    }

    public function verify(VerifyUserAction $verifyUserAction)
    {
        try {
            $validateData = $this->validate();

            $user = $verifyUserAction->execute($validateData['code'], $this->email, session('user_id'));

            Auth::login($user, true);

            $this->redirectRoute('dashboard.index', navigate: true);

        } catch (Exception $exception) {
            $this->addError('code', $exception->getMessage());
        }
    }

    public function resendCode(ResendCodeUserAction $resendCodeUserAction)
    {
        try {
            $resendCodeUserAction->execute(session('user_id'));

            $this->redirectRoute('verify', navigate: true);
        }catch (Exception $exception){
            $this->addError('code',$exception->getMessage());
        }
    }
};
?>

<div class="flex justify-center items-center flex-col overflow-hidden">

    <div class="w-auto h-auto border-0  rounded-lg lg:border lg:border-gray-200">

        <div class="flex justify-center items-center">
            <i class="fa fa-arrow-right my-10 ml-30"></i>
            <img class="size-[70px] my-5 ml-30" src="{{ asset('storage/logo/logo.jpg') }}" alt="">
        </div>

        <h3 class="font-semibold text-xl mx-10 my-5">کد تایید رو وارد کنید</h3>

        <p class="text-gray-500 text-sm mx-10">کد تایید به ایمیل <span x-text="$wire.email"
                                                                       class="font-extrabold underline"
                                                                       :class="dark ? 'text-white' : 'text-black'"></span>
            ارسال شد.</p>
        <p class="text-gray-500 text-sm mx-10">لطفا کد 6 رقمی را وارد کنید.</p>

        <div class="text-center mt-3"
             x-data="{
        expiresAt: {{ $this->expires_at }},
        timeLeft: '00:00',
        expired:false
    }"
             x-init="
        const updateTimer = () => {

            let diff = expiresAt - Date.now();

            if (diff <= 0) {
                timeLeft = '00:00';
                expired = true;
                return;
            }

            let minutes = Math.floor(diff / 60000);
            let seconds = Math.floor((diff % 60000) / 1000);

            timeLeft =
                String(minutes).padStart(2, '0')
                + ':' +
                String(seconds).padStart(2, '0');
        };

        updateTimer();

        setInterval(updateTimer, 1000);
    "
        >
            <div x-show="!expired">
                <span x-text="timeLeft"></span>
            </div>
            <div x-show="expired">

                <button
                    wire:click="resendCode"
                    class="text-blue-600 cursor-pointer"
                >
                    ارسال مجدد کد
                </button>

            </div>
        </div>

        <div class="flex justify-center items-center w-full">
            <form wire:submit="verify" class="w-full px-10">

                <div class="relative w-full my-5 xl:w-full lg:w-[650px] md:w-[720px] sm:w-[610px]">
                    <input wire:model.blur="code" autofocus class="text-center text-xl border-gray-300 border-3 border rounded-sm w-full h-11 px-4 text-sm
                    outline-none transition-all focus:border-blue-500" type="text" placeholder=" " maxlength="6">
                </div>

                <button class="mb-5 w-full h-[50px] bg-[#ef4056] rounded-lg text-white cursor-pointer hover:bg-linear-to-r from-indigo-500 via-purple-500 to-pink-500
                 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 " type="submit">
                    تایید
                </button>
            </form>

        </div>

        <div class="p-[5px] text-center" wire:show="$errors.has('code')">
            @error('code')
            <span class="text-sm text-red-600" wire:text="$errors.first('code')"></span>
            @enderror
        </div>
    </div>

</div>
