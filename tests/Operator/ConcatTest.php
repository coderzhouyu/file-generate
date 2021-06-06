<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class ConcatTest extends TestCase
{
    public function testConcat()
    {
        $this->assertEquals(Standard::output(
            Operator::concat('a', 'b')
        ), $this->concat());
    }


    protected function concat()
    {
        return <<<PHP
\$a . \$b
PHP;

    }
}