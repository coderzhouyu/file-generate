<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class SmallerOrEqualTest extends TestCase
{
    public function testSmallerOrEqual()
    {
        $this->assertEquals(Standard::output(
            Operator::smallerOrEqual('a', 'b')
        ), $this->smallerOrEqual());
    }


    protected function smallerOrEqual()
    {
        return <<<PHP
\$a <= \$b
PHP;

    }
}