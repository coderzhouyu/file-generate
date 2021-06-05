<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class NotIdenticalTest extends TestCase
{
    public function testNotEqual()
    {
        $this->assertEquals(Standard::output(
            Operator::notIdentical('a', 'b')
        ), $this->notIdentical());
    }


    protected function notIdentical()
    {
        return <<<PHP
\$a !== \$b
PHP;

    }
}