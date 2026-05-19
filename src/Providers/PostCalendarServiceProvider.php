<?php

declare(strict_types=1);

namespace Molitor\PostCalendar\Providers;

use Illuminate\Support\ServiceProvider;

class PostCalendarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'post-calendar');
    }
}
