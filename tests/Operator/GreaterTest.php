<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class GreaterTest extends TestCase
{
    public function testGreater()
    {
        $this->assertEquals(Standard::output(
            Operator::greater('a', 'b')
        ), $this->greater());
    }


    protected function greater()
    {
        return <<<PHP
\$a > \$b
PHP;

    }
}