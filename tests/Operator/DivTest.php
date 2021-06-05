<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class DivTest extends TestCase
{
    public function testConcat()
    {
        $this->assertEquals(Standard::output(
            Operator::div('a', 'b')
        ), $this->div());
    }


    protected function div()
    {
        return <<<PHP
\$a / \$b
PHP;

    }
}