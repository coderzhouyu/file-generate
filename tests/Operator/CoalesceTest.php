<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class CoalesceTest extends TestCase
{
    public function testConcat()
    {
        $this->assertEquals(Standard::output(
            Operator::coalesce('a', 'b')
        ), $this->coalesce());
    }


    protected function coalesce()
    {
        return <<<PHP
\$a ?? \$b
PHP;

    }
}