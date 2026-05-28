<?php

namespace Molitor\PostCalendar\Tests\Feature;

use Molitor\PostCalendar\Providers\PostCalendarServiceProvider;
use Tests\TestCase;

class PackageSmokeTest extends TestCase
{
    public function test_service_provider_is_loaded(): void
    {
        $this->assertTrue(class_exists(PostCalendarServiceProvider::class));
        $this->assertTrue($this->app->providerIsLoaded(PostCalendarServiceProvider::class));
    }
}

