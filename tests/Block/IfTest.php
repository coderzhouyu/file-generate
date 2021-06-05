<?php
namespace Test\Block;

use JaguarJack\Generate\Block\Elseif_;
use JaguarJack\Generate\Block\If_;
use JaguarJack\Generate\Build\Operator;
use JaguarJack\Generate\Build\Value;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;
use Test\Standard;

class IfTest extends TestCase
{
    public function testConcat()
    {
        $if = new If_(Operator::greater('a', Value::fetch(123)));

        $if->elseif(
            Elseif_::condition(Operator::smaller('a', 'b'))
            ->block([
                Variable::fetch('good', 'this is good mind')
            ])
        )->else([
            Variable::fetch('a', '123')
        ]);

        $this->assertEquals(Standard::output(
            $if->fetch()
        ), $this->if());
    }


    protected function if()
    {
        return <<<PHP
if (\$a > 123) {
} elseif (\$a < \$b) {
    \$good = 'this is good mind';
} else {
    \$a = '123';
}
PHP;

    }
}