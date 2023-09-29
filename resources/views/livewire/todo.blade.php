<?php
use \App\Enums\TodoStatus;
use function Livewire\Volt\{state,computed,on};
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
$open = function (){
	\Native\Laravel\Facades\Window::open('todo-detail')
        ->route('todo.show', [$this->todo])
        ->focusable(true);
};
$done = function(){
	if($this->todo->percent >= 100){
		$this->todo->update(['status' => TodoStatus::DONE]);
    }
};
?>

<div class="w-full max-w-xs mx-auto bg-white data-[overing=true]:bg-yellow-100 data-[dragging=true]:shadow-md border p-2 rounded text-gray-800 flex items-center justify-between space-x-2" wire:sortable.item="{{ $todo->id }}">
    <div class="flex items-center justify-between w-full">
        @if($isEdit)
            <label class="w-full max-w-xs flex items-center justify-start">
                <input class="w-full h-full text-sm focus:outline-none" wire:model="description" placeholder="Enter your Todo"  >
                <button class="focus:outline-none" wire:click="update">
                    <x-heroicon-o-check class="w-5 aspect-square" />
                </button>
            </label>
        @else
            <p wire:click="edit" class="text-sm w-full" {{$todo->percent < 100 && $todo->status === TodoStatus::ON_GOING  ? "wire:poll.500ms" : ""}} >{{ $todo->description ?? 'Unknown' }}</p>
        @endif

        <div class="relative w-7 aspect-square">
            <div class="group hover:absolute hover:right-0 hover:bg-white rounded-full border p-1 items-center justify-center flex relative bg-{{$todo->status->color()}}-500/50" >
                <x-svg-percent percent="{{$todo->percent}}" class="aspect-square group-hover:hidden w-7 absolute stroke-2 stroke-{{$todo->status->color()}}-800"/>
                <span class="text-xs group-hover:hidden">@svg($todo->status->sVG(), ['class' => 'w-4 h-4 text-gray-800'])</span>
                <span class="text-xs group-hover:flex hidden space-x-2 bg-white">
                    @foreach(TodoStatus::cases() as $status)
                        @if($status === TodoStatus::PENDING) @continue @endif
                        <button class="text-xs" wire:click="updateStatus({{ $status->value }})">
                            @svg($status->sVG(), ['class' => 'w-4 h-4 text-gray-800 ' . "stroke-{$status->color()}-800"])
                        </button>
                    @endforeach
                </span>
            </div>
        </div>
    </div>
    <button wire:sortable.handle wire:click="open">
        <x-heroicon-o-arrows-up-down class="w-4 h-4" />
    </button>
</div>
