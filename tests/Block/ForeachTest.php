<?php
namespace Test\Block;

use JaguarJack\Generate\Control;
use JaguarJack\Generate\Operator;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class ForeachTest extends TestCase
{
    public function testForeach()
    {
        $foreach = Control::foreach('arr', 'val')
            ->refValue()
            ->block([
                Control::if(Operator::greater('val', 123))->block([
                    new Variable('value')
                ], true)
                ->elseif(
                    Control::elseif(Operator::greater('var', '333'))->block([
                    ])
                )->fetch()
            ])->fetch();

        $this->assertEquals(Standard::output(
            $foreach
        ), $this->foreach());
    }


    protected function foreach()
    {
        return <<<PHP
foreach (\$arr as &\$val) {
    if (\$val > \$123) {
        return \$value;
    } elseif (\$var > \$333) {
    }
}
PHP;

    }
}