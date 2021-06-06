<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class MinusTest extends TestCase
{
    public function testMinus()
    {
        $this->assertEquals(Standard::output(
            Operator::minus('a', 'b')
        ), $this->minus());
    }


    protected function minus()
    {
        return <<<PHP
\$a - \$b
PHP;

    }
}
