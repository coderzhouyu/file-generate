<?php
namespace Test\Block;

use JaguarJack\Generate\Block\Elseif_;
use JaguarJack\Generate\Block\If_;
use JaguarJack\Generate\Block\Switch_;
use JaguarJack\Generate\Block\While_;
use JaguarJack\Generate\Control;
use JaguarJack\Generate\Operator;
use JaguarJack\Generate\Build\Value;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class SwitchTest extends TestCase
{
    public function testSwitch()
    {

        $switch = Control::switch(Operator::greater('a', Value::fetch(123)))

            ->cases([
                Control::case(Value::fetch(123), [
                    Variable::fetch('a', 123)
                ], true),

                Control::case(null, [
                    Variable::fetch('b', 123)
                ])
            ])->fetch();

        $this->assertEquals(Standard::output(
            $switch
        ), $this->switch());
    }


    protected function switch()
    {
        return <<<PHP
switch (\$a > 123) {
    case 123:
        \$a = 123;
        break;
    default:
        \$b = 123;
        break;
}
PHP;

    }
}