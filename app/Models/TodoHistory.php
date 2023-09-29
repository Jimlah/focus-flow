<?php

namespace App\Models;

use App\Enums\TodoStatus;
use App\Events\StatusChanged;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Immutable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Attributes\Watch;
use WendellAdriel\Lift\Lift;

#[BelongsTo(Todo::class)]
class TodoHistory extends Model
{
    use HasFactory;
    use Lift;

    #[Immutable]
    #[PrimaryKey]
    public int $id;

    #[Immutable]
    #[Fillable]
    public int $todo_id;

    #[Cast(TodoStatus::class)]
    #[Fillable]
    public TodoStatus $status;

    #[Cast('datetime')]
    #[Fillable]
    public Carbon $started_at;

}
