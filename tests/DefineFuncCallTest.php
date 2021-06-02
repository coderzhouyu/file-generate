<?php
namespace Test;

use JaguarJack\Generate\Build\Closure;
use JaguarJack\Generate\Build\FunctionCall;
use JaguarJack\Generate\Build\Params;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;

class DefineFuncCallTest extends TestCase
{
    public function testFuncCall()
    {
        $this->assertEquals(Standard::output(
            Variable::fetch('a',
            FunctionCall::name('explode')->args(',', 'q,b,q,w,')
            )
        ), $this->funcCall());
    }


    protected function funcCall()
    {
        return <<<PHP
\$a = explode(',', 'q,b,q,w,');
PHP;
    }


    public function testFuncCallClosure()
    {
        $this->assertEquals(Standard::output(
            Variable::fetch('a',
                FunctionCall::name('array_walk')->args(
                    (new Closure)->addParams(
                        Params::name('a')
                    )->uses('b')
                )
            )
        ), $this->funcCallClosure());
    }


    protected function funcCallClosure()
    {
        return <<<PHP
\$a = array_walk(function (\$a) use(\$b) {
});
PHP;

    }

}