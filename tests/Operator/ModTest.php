<?php
namespace Test\Operator;

use JaguarJack\Generate\Build\Operator;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class ModTest extends TestCase
{
    public function testMod()
    {
        $this->assertEquals(Standard::output(
            Operator::mod('a', 'b')
        ), $this->mod());
    }


    protected function mod()
    {
        return <<<PHP
\$a % \$b
PHP;

    }
}
