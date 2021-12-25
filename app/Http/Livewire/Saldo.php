<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Indodax;

class Saldo extends Component
{

    public $balance;
    public $readyToLoad = false;

    public function loadBalance()
    {
        $this->readyToLoad = true;
    }

    public function getSaldo()
    {
        try {
            $this->balance = (new Indodax())->setUser(auth()->id())->getSaldoIdr();
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
