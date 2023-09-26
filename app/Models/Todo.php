<?php

namespace App\Models;

use App\Enums\TodoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

class Todo extends Model
{
    use HasFactory;
    use Lift;

    #[PrimaryKey]
    public int $id;

    #[Cast('string')]
    #[Fillable]
    public ?string $description;

    #[Cast(TodoStatus::class)]
    #[Fillable]
    public TodoStatus $status;

    #[Cast('int')]
    #[Fillable]
    public int $order;
}
