<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Filament\Widgets\Widget;
use Filament\Widgets\Concerns\CanPoll;
use Illuminate\Support\Facades\DB;

class OverviewWidget extends Widget
{
    protected static string $view = 'filament.widgets.overview-widget';

    protected int | string | array $columnSpan = 'full';
}
