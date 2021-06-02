<?php
namespace Test;

use JaguarJack\Generate\Types\Array_;
use PHPUnit\Framework\TestCase;

class DefineArrayTest extends TestCase
{
    public function testArray()
    {
        $arr = new Array_([
            'a' => 123,
            'b' => 123
        ], false);


        $this->assertEquals(Standard::output($arr), $this->array());
    }


    protected function array()
    {
        return <<<PHP
['a' => 123, 'b' => 123]
PHP;

    }
}