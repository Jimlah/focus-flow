<?php

use function Livewire\Volt\{state,title,mount};
use \App\Models\Todo;
title('Todo Detail');
state('todo');

mount(function (Todo $todo) {
	$this->todo = $todo->load('histories');
});

?>

<div class="w-full p-6">
    <div class="flex flex-col items-start justify-start mx-4">
        @foreach($todo->histories as $history)
            <div class="w-full rounded-md before:border-l first:before:border-none last:after:border-none h-fit after:border-l before:p-6 after:p-6">
                <div class="flex items-center justify-start w-full -ml-4 space-x-3">
                    <span class="w-10 aspect-square flex items-center z-10 justify-center border rounded-full bg-{{$history->status->color()}}-500/50 drop-shadow-md">
                        @svg($history->status->sVG(), ['class' => 'w-6 h-6 text-gray-800 ' . "stroke-{$history->status->color()}-800"])
                    </span>
                    <div class="shadow-md flex flex-col items-start justify-start p-2 rounded-md w-full bg-white">
                        <p class="text-sm font-semibold">{{ $history->status->description() }}</p>
                        <span class="text-xs">{{ $history->started_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
