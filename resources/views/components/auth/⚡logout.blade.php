<?php

use App\Actions\Auth\LogoutUserAction;
use Livewire\Component;

new class extends Component {
    public function logout(LogoutUserAction $logoutUserAction)
    {
        $logoutUserAction->execute();

        $this->redirect('/',navigate: true);
    }
};
?>


<li class="group flex items-center gap-3 rounded-xl px-4 py-3 transition-all duration-300 cursor-pointer
        hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white hover:shadow-lg">

    <i class="fa-solid fa-right-from-bracket text-gray-500 transition-all duration-300 group-hover:text-white"></i>
    <a wire:click="logout">خروج</a>
</li>
