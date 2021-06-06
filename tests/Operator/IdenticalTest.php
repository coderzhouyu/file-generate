<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class IdenticalTest extends TestCase
{
    public function testMinus()
    {
        $this->assertEquals(Standard::output(
            Operator::identical('a', 'b')
        ), $this->identical());
    }


    protected function identical()
    {
        return <<<PHP
\$a === \$b
PHP;

    }
}