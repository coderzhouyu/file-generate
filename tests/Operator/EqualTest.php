<?php
namespace Test\Operator;

use JaguarJack\Generate\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class EqualTest extends TestCase
{
    public function testConcat()
    {
        $this->assertEquals(Standard::output(
            Operator::equal('a', 'b')
        ), $this->equal());
    }


    protected function equal()
    {
        return <<<PHP
\$a == \$b
PHP;

    }
}