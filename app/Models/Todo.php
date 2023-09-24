<?php

namespace App\Models;

use App\Enums\Metadata\Color;
use App\Enums\Metadata\Description;
use App\Enums\TodoStatus;
use ArchTech\Enums\Meta\Meta;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

class Todo extends Model
{
    use Lift;
    use HasFactory;

    #[PrimaryKey]
    public int $id;

    #[Cast('string')]
    #[Fillable]
    public ?string $description;

    #[Cast(TodoStatus::class)]
    #[Fillable]
    public TodoStatus $status;
}
