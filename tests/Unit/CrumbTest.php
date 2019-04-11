<?php

namespace Dluwang\Breadcrumb\Tests\Unit;

use Dluwang\Breadcrumb\Crumb;
use Kastengel\Packdev\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrumbTest extends TestCase
{
    /**
     * @var Crumb
     */
    protected $crumb;

    /**
     * Setup test.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();

        $this->crumb = new Crumb('test.crumb', 'Crumb test', '/');
    }

    /**
     * Test if it initalizable.
     *
     * @return void
     */
    public function testItIsInitializable()
    {
        $this->assertSame($this->crumb->id, 'test.crumb');
        $this->assertSame($this->crumb->label, 'Crumb test');
        $this->assertSame($this->crumb->url, '/');
        $this->assertSame($this->crumb->prev, null);
    }

    /**
     * Test it may have previous crumb
     *
     * @return void
     */
    public function testItMayHavePreviousCrumb()
    {
        $home = new Crumb('home', 'Home', '/');
        $this->crumb->prev($home);

        $this->assertSame($this->crumb->prev->id, 'home');
    }

    /**
     * Test it can be casted to types
     *
     * @return void
     */
    public function testItCanBeCastedToTypes()
    {
        $home = new Crumb('home', 'Home', '/');
        $this->crumb->prev($home);

        $expected = [
            ['id' => 'home', 'label' => 'Home', 'url' => '/'],
            ['id' => 'test.crumb', 'label' => 'Crumb test', 'url' => '/'],
        ];

        $this->assertSame($this->crumb->toArray(), $expected);
        $this->assertSame(json_encode($this->crumb), json_encode($expected));
        $this->assertSame($this->crumb->toJson(), json_encode($expected));
        $this->assertSame((string)$this->crumb, json_encode($expected));
    }
}
