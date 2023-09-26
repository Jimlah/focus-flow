<?php

use function Livewire\Volt\{state,computed};
state('todo');
state('description');
state('time', 10);
state(['isEdit' => false]);
$updateStatus = fn($status) => $this->todo->update(['status' => $status]);
$percent = computed(fn() => now());
$update = function(){
	$this->todo->update(['description' => $this->description]);
	$this->isEdit = false;
};
$edit = function(){
    $this->isEdit = true;
	$this->description = $this->todo->description;
};
?>

<div class="w-full max-w-xs mx-auto bg-white data-[overing=true]:bg-yellow-100 data-[dragging=true]:shadow-md border p-2 rounded text-gray-800 flex items-center justify-between space-x-2" x-sortable:item="{{ $todo->id }}">
    <div class="flex items-center justify-between w-full">
        @if($isEdit)
            <label class="w-full max-w-xs flex items-center justify-start">
                <input class="w-full h-full text-sm focus:outline-none" wire:model="description" placeholder="Enter your Todo"  >
                <button class="focus:outline-none" wire:click="update">
                    <x-heroicon-o-check class="w-5 aspect-square" />
                </button>
            </label>
        @else
            <p wire:click="edit" class="text-sm w-full">{{ $todo->description ?? 'Unknown' }}</p>
        @endif

        <div class="relative w-7 aspect-square">
            <div class="group hover:absolute hover:right-0 rounded-full border p-1 items-center justify-center flex bg-white relative" >
                <x-svg-percent percent="{{$this->percent}}" class="aspect-square group-hover:hidden w-7 absolute stroke-2 stroke-red-800" />
                <span class="text-xs group-hover:hidden">@svg($todo->status->sVG(), ['class' => 'w-4 h-4 text-gray-800'])</span>
                <span class="text-xs group-hover:flex hidden space-x-2">
                    @foreach(\App\Enums\TodoStatus::cases() as $status)
                        @if($status === \App\Enums\TodoStatus::PENDING) @continue @endif
                        <button class="text-xs" wire:click="updateStatus({{ $status->value }})">
                            @svg($status->sVG(), ['class' => 'w-4 h-4 text-gray-800'])
                        </button>
                    @endforeach
                </span>
            </div>
        </div>
    </div>
    <button x-sortable:handle>
        <x-heroicon-o-arrows-up-down class="w-4 h-4" />
    </button>
</div>
