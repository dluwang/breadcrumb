<?php

namespace Dluwang\Breadcrumb\Tests\Unit;

use Dluwang\Breadcrumb\Crumb;
use Dluwang\Breadcrumb\Breadcrumb;
use Dluwang\Breadcrumb\InMemoryBreadcrumb;
use Kastengel\Packdev\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InMemoryBreadcrumbTest extends TestCase
{
    /**
     * @var array
     */
    protected $crumbs = [];

    /**
     * @var InMemoryBreadcrumb
     */
    protected $breadcrumb;

    /**
     * Setup test.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();

        $home = new Crumb('home', 'Home', '/');
        $dashboard = new Crumb('dashboard', 'Dashboard', '/');

        $dashboard->prev($home);

        $this->crumbs = [$home, $dashboard];

        $this->breadcrumb = new InMemoryBreadcrumb($this->crumbs);
    }

    /**
     * Test if it initalizable.
     *
     * @return void
     */
    public function testItIsInitializable()
    {
        $this->assertTrue($this->breadcrumb instanceof Breadcrumb);
    }

    public function testItCanRegisterCrumb()
    {
        $crumb1 = new Crumb('module1', 'Module 1', '/');
        $crumb2 = new Crumb('module2', 'Module 2', '/');
        $crumb3 = new Crumb('module3', 'Module 3', '/');

        $this->breadcrumb->register($crumb1);
        $this->breadcrumb->register($crumb1);
        $this->breadcrumb->register([$crumb2, $crumb3]);

        $this->assertSame($this->breadcrumb->crumb('module1'), $crumb1);
    }

    public function testItCanApplyGlobalPrevious()
    {
        $global = new Crumb('global', 'Global', '/');
        $crumb1 = new Crumb('module1', 'Module 1', '/');
        $crumb2 = new Crumb('module2', 'Module 2', '/');

        $crumb1->prev($this->crumbs[0]);
        $crumb2->prev($crumb1);

        $this->breadcrumb->prev($global);
        $this->breadcrumb->register([$crumb1, $crumb2]);

        $this->assertSame($this->breadcrumb->crumb('home')->prev->id, 'global');
        $this->assertSame($this->breadcrumb->crumb('module2')->prev->prev->prev->id, 'global');
    }
}
