<?php
namespace Test;


use JaguarJack\Generate\Build\Closure;
use JaguarJack\Generate\Build\Params;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;

class DefineClosureTest extends TestCase
{
    public function testClosure()
    {
        $closure = new Closure();

        $closure->addParams('userModel', 'b', Params::name('c')->ref())
                ->uses('c', 'd')
                ->body([
                    Variable::fetch('a', 123),

                    new Variable('a')
                ])->return();


        $this->assertEquals(Standard::output($closure), $this->closure());
    }


    protected function closure()
    {
        return <<<PHP
function (\$userModel, \$b, &\$c) use(\$c, \$d) {
    \$a = 123;
    return \$a;
}
PHP;

    }
}