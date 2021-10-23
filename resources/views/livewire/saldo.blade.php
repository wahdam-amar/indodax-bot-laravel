<div wire:init="loadBalance" wire:poll.visible.20000ms>
    <div wire:loading.remove>
        {{ $balance }}
    </div>

    <div wire:loading.inline>
        <x-loading />
    </div>

</div>