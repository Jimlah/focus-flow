<?php

namespace App\Enums;

use App\Enums\Metadata\Color;
use App\Enums\Metadata\Description;
use App\Enums\Metadata\SVG;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Meta\Meta;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

#[Meta(Description::class, Color::class, SVG::class)]
enum TodoStatus: int
{
    use InvokableCases;
    use Metadata;
    use Options;
    use Values;

    #[Description('Pending')]
    #[SVG('heroicon-o-play')]
    #[Color('gray')]
    case PENDING = 0;

    #[Description('On going')]
    #[SVG('heroicon-o-play')]
    #[Color('green')]
    case ON_GOING = 1;

    #[Description('Done')]
    #[SVG('heroicon-o-check')]
    #[Color('blue')]
    case DONE = 2;

    #[Description('Canceled')]
    #[SVG('heroicon-o-x-mark')]
    #[Color('red')]
    case CANCELLED = 3;

    #[Description('Hold')]
    #[SVG('heroicon-o-pause')]
    #[Color('yellow')]
    case HOLD = 4;
}
