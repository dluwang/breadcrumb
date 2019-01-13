<?php

namespace Dluwang\Breadcrumb\Tests\Feature;

use Kastengel\Packdev\Tests\TestCase;
use Dluwang\Breadcrumb\Breadcrumb;
use Dluwang\Breadcrumb\InMemoryBreadcrumb;
use Dluwang\Breadcrumb\Laravel\BreadcrumbServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreadcrumbServiceProviderTest extends TestCase
{
    /**
     * Test it if service provider is loaded.
     *
     * @return void
     */
    public function testItisLoaded()
    {
        $providers = $this->app->getLoadedProviders();

        $this->assertTrue(isset($providers[BreadcrumbServiceProvider::class]));
        $this->assertTrue($this->app->make(Breadcrumb::class) instanceof InMemoryBreadcrumb);
    }
}
