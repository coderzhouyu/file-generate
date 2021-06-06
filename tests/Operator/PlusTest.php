<?php

namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class PlusTest extends TestCase
{
    public function testPlus()
    {
        $this->assertEquals(Standard::output(
            Operator::plus('a', 'b')
        ), $this->plus());
    }


    protected function plus()
    {
        return <<<PHP
\$a + \$b
PHP;

    }
}
