<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;

enum Period: string
{
    use InvokableCases;
    use Metadata;
    use Options;
    use Values;

    case SECONDS = 's';
    case MINUTES = 'm';
    case HOURS = 'h';
    case DAYS = 'd';
    case MONTHS = 'M';
}
