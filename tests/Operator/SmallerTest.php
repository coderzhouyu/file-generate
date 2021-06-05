<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class SmallerTest extends TestCase
{
    public function testSmaller()
    {
        $this->assertEquals(Standard::output(
            Operator::smaller('a', 'b')
        ), $this->smaller());
    }


    protected function smaller()
    {
        return <<<PHP
\$a < \$b
PHP;

    }
}