<?php

use function Livewire\Volt\{state,computed};
state('todo');
state('time', 10);
$updateStatus = fn($status) => $this->todo->update(['status' => $status]);
$percent = computed(fn() => now());
?>

<div class="w-full max-w-xs mx-auto border p-2 rounded text-gray-800 flex items-center justify-between space-x-2">
    <div class="flex items-center justify-between w-full">
        <p class="text-sm">{{ $this->percent }}</p>
        <div class="group rounded-full border p-1 items-center justify-center flex bg-white relative" wire:poll.500ms>
            <x-svg-percent percent="{{$this->percent}}" class="aspect-square group-hover:hidden w-7 absolute stroke-2 stroke-red-800" />
               <span class="text-xs group-hover:hidden">@svg($todo->status->sVG(), ['class' => 'w-4 h-4 text-gray-800'])</span>
               <span class="text-xs group-hover:flex flex-wrap hidden space-x-2">
                @foreach(\App\Enums\TodoStatus::cases() as $status)
                       @if($status === \App\Enums\TodoStatus::PENDING) @continue @endif
                       <button class="text-xs" wire:click="updateStatus({{ $status->value }})">
                        @svg($status->sVG(), ['class' => 'w-4 h-4 text-gray-800'])
                    </button>
                   @endforeach
            </span>
           </div>

    </div>
    <button>
        <x-heroicon-o-arrows-up-down class="w-4 h-4" />
    </button>
</div>
