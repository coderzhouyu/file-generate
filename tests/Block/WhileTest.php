<?php
namespace Test\Block;

use JaguarJack\Generate\Block\Elseif_;
use JaguarJack\Generate\Block\If_;
use JaguarJack\Generate\Block\While_;
use JaguarJack\Generate\Control;
use JaguarJack\Generate\Operator;
use JaguarJack\Generate\Build\Value;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class WhileTest extends TestCase
{
    public function testWhile()
    {
        $while = Control::while(Operator::greater('a', Value::fetch(123)))
            ->block([
                Variable::fetch('a', 123)
            ])->break()->fetch();

        $this->assertEquals(Standard::output(
            $while
        ), $this->while());
    }


    protected function while()
    {
        return <<<PHP
while (\$a > 123) {
    \$a = 123;
    break;
}
PHP;

    }
}