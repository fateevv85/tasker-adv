<?php

namespace frontend\tests;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->assertEquals(4, 2 + 2);
    }

    public function testSomeFeature1()
    {
        $this->assertEquals(6, 3 + 3);
    }
}