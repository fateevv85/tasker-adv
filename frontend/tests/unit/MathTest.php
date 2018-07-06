<?php

namespace frontend\tests;

use frontend\models\Test;

class MathTest extends \Codeception\Test\Unit
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
    public function testSum()
    {
        $model = new Test();
        $model->a = 3;
        $model->b = 2;

        $res = $model->sum();
        $this->assertTrue(is_numeric($res));
        $this->assertEquals(5, $res);
        $model->a = 3;
        $model->b = 7;

        $res = $model->sum();
        $this->assertTrue(is_numeric($res));
        $this->assertEquals(10, $res);
    }

    public function testMul()
    {
        $model = new Test();
        $model->a = 3;
        $model->b = 2;

        $res = $model->mul();
        $this->assertTrue(is_numeric($res));
        $this->assertEquals(6, $res);

        $model->a = 3;
        $model->b = 7;

        $res = $model->mul();
        $this->assertTrue(is_numeric($res));
        $this->assertEquals(21, $res);
    }
}