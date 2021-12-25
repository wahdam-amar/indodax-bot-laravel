<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

class Table extends Component
{

    public $readyToLoad = false;

    public $orders;

    protected $listeners = ['orderCanceled' => 'getOrders'];

    public function loadBalance()
    {
        $this->readyToLoad = true;
    }

    function getOrders()
    {
        $indodax = indodax();

        $this->orders = collect($indodax->openOrders());
    }

    public function render()
    {
        return view('livewire.order.table', [
            'orders' => $this->readyToLoad ? $this->getOrders() : [],
        ]);
    }
}
