<?php

use App\Models\Todo;

use function Livewire\Volt\{state, action, computed};

state('description');
$todos = computed(fn() => Todo::query()->orderBy('order')->get());
$add = function () {
    $this->validate(['description' => 'required']);
    Todo::query()->create(['description' => $this->description]);
    $this->description = '';
};
$updateOrder = action(fn($items) => collect($items)->each(fn($item) => Todo::query()->find($item['value'])->update(['order' => $item['order']])))->renderless();
?>

<div x-data class="flex items-center justify-center space-y-4 flex-col w-full h-screen px-10">
    <div class="w-full max-w-xs">
        <label class="w-full max-w-xs flex items-center justify-start  border p-2">
            <input class="w-full h-full text-sm focus:outline-none" wire:model="description"
                   placeholder="Enter your Todo">
            <button class="focus:outline-none" wire:click="add">
                <x-heroicon-o-plus class="w-5 aspect-square"/>
            </button>
        </label>
        <span class="text-xs text-red-500">@error('description'){{ $message }}@enderror</span>
    </div>

    <div class="flex items-center justify-center space-y-4 flex-col w-full px-10" x-sortable="updateOrder">
        @foreach($this->todos as $todo)
            <livewire:todo :$todo :key="$todo->id"/>
        @endforeach
    </div>
</div>
