<?php

namespace App\Http\Livewire\Order;

use App\Services\Account\LiveAccount;
use Livewire\Component;

class Cancel extends Component
{
    public $orderId;
    public $pair;
    public $type;

    public function cancel()
    {
        $account = new LiveAccount(auth()->id());

        $account->cancelOrder($this->pair, $this->orderId, $this->type);

        $this->emit('orderCanceled');
    }

    public function render()
    {
        return view('livewire.order.cancel');
    }
}
