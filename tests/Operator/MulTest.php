<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class MulTest extends TestCase
{
    public function testMul()
    {
        $this->assertEquals(Standard::output(
            Operator::mul('a', 'b')
        ), $this->mul());
    }


    protected function mul()
    {
        return <<<PHP
\$a * \$b
PHP;

    }
}