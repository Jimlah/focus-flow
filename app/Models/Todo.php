<?php

namespace App\Models;

use App\Enums\Period;
use App\Enums\TodoStatus;
use App\Events\StatusChanged;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Watch;
use WendellAdriel\Lift\Lift;

#[HasMany(TodoHistory::class, 'histories')]
class Todo extends Model
{
    use HasFactory;
    use Lift;

    #[PrimaryKey]
    public int $id;

    #[Cast('string')]
    #[Fillable]
    public ?string $description;

    #[Watch(StatusChanged::class)]
    #[Cast(TodoStatus::class)]
    #[Fillable]
    public TodoStatus $status;

    #[Cast('int')]
    #[Fillable]
    public int $order;

    #[Cast('float')]
    #[Fillable]
    public float $quantity;

    #[Cast(Period::class)]
    #[Fillable]
    public Period $period;

    public function percent(): Attribute
    {
        return Attribute::get(function () {
            $percent = $this->histories->reduce(function (int $carry, TodoHistory $history, int $key) {
                $item = 0;
                if ($history->status === TodoStatus::ON_GOING) {
                    $next = $this->histories->get($key + 1)?->started_at ?? now();
                    $item = $next->diffInSeconds($history->started_at);
                }
                return $carry + $item;
            }, 0);
            $total = CarbonInterval::fromString("{$this->quantity} {$this->period->value}")->totalSeconds;
            $percent = ($percent / $total) * 100;
            $percent = min($percent, 100);
            return round($percent, 2);
        });
    }
}
