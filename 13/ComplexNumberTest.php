<?php
require_once "ComplexNumber.php";

use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase
{
    public function testAbs()
    {
        $cn1 = new ComplexNumber(0, 0);
        $cn2 = new ComplexNumber(-1, 1);
        self::assertEquals(0.0, $cn1->abs());
        self::assertEquals(sqrt(2), $cn2->abs());
    }

    /**
     * @dataProvider additionProvider1
     */
    public function testSum($r1, $i1, $r2, $i2, $eR, $eI)
    {

        $cn1 = new ComplexNumber($r1, $i1);
        $cn2 = new ComplexNumber($r2, $i2);
        self::assertEquals(new ComplexNumber($eR, $eI), ComplexNumber::sum($cn1, $cn2));
    }

    public function additionProvider1()
    {
        return [
            [0, 0, 0, 0, 0.0, 0.0],
            [1,1,2,2,3,3],
            [10,5,-10,-5,0,0]
        ];
    }

    /**
     * @dataProvider additionProvider2
     */
    public function testSub($r1, $i1, $r2, $i2, $eR, $eI){
        $cn1 = new ComplexNumber($r1, $i1);
        $cn2 = new ComplexNumber($r2, $i2);

        self::assertEquals(new ComplexNumber($eR,$eI),ComplexNumber::subtract($cn1,$cn2));
    }
    public function additionProvider2()
    {
        return [
            [0, 0, 0, 0, 0.0, 0.0],
            [1,1,2,2,-1,-1],
            [5,0,-10,-5,15,5]
        ];
    }

    /**
     * @dataProvider additionProvider3
     */
    public function testMult($r1, $i1, $r2, $i2, $eR, $eI){
        $cn1 = new ComplexNumber($r1, $i1);
        $cn2 = new ComplexNumber($r2, $i2);

        self::assertEquals(new ComplexNumber($eR,$eI),ComplexNumber::multiply($cn1,$cn2));
    }
    public function additionProvider3()
    {
        return [
            [0, 0, 0, 0, 0.0, 0.0],
            [1,1,2,2,0,4],
            [0,100,10,5,-500,1000]
        ];
    }

    /**
     * @dataProvider additionProvider4
     */
    public function testDiv($r1, $i1, $r2, $i2, $eR, $eI){
        $cn1 = new ComplexNumber($r1, $i1);
        $cn2 = new ComplexNumber($r2, $i2);
        self::assertEquals(new ComplexNumber($eR,$eI),ComplexNumber::divide($cn1,$cn2));
    }
    public function additionProvider4()
    {
        return [
            [1,1,2,2,0.5,0],
        ];
    }



    /**
     * @dataProvider additionProvider5
     */
    public function testToString($r1, $i1){
        $cn1 = new ComplexNumber($r1, $i1);

        self::assertEquals("0+0i",$cn1->__toString());
    }
    public function additionProvider5()
    {
        return [
            [0,0,],
        ];
    }
}