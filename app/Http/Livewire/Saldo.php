<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Indodax;

class Saldo extends Component
{

    public $user;
    public $balance;
    public $readyToLoad = false;

    public function loadBalance()
    {
        $this->readyToLoad = true;
    }

    public function getSaldo()
    {
        if (!$this->user->api()->exists()) {
            $this->balance = 0;
        }

        try {
            $this->balance = (new Indodax())->setUser($this->user)->getSaldoIdr();
        } catch (\Throwable $th) {
            $this->balance = 0;
        }
    }

    public function render()
    {
        return view('livewire.saldo', [
            'balance' => $this->readyToLoad ? $this->getSaldo() : 0,
        ]);
    }
}
