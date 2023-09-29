<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use App\Models\TodoHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogStatusHistory
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StatusChanged $event): void
    {
        TodoHistory::query()->create([
            'todo_id' => $event->todo->id,
            'status' => $event->todo->status,
            'started_at' => now(),
        ]);
    }
}
