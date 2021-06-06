<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class NotEqualTest extends TestCase
{
    public function testNotEqual()
    {
        $this->assertEquals(Standard::output(
            Operator::notEqual('a', 'b')
        ), $this->notEqual());
    }


    protected function notEqual()
    {
        return <<<PHP
\$a != \$b
PHP;

    }
}