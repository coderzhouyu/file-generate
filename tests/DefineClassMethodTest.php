<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use JaguarJack\Generate\Build\ClassMethod;
use JaguarJack\Generate\Build\MethodCall;
use JaguarJack\Generate\Build\Params;
use JaguarJack\Generate\Build\Value;
use JaguarJack\Generate\Build\Variable;
use PhpParser\Builder\Param;
use PHPUnit\Framework\TestCase;

class DefineClassMethodTest extends TestCase
{
    public function testClassMethod()
    {
        $output = Standard::output(Class_::name('Test')
                    ->useMethod(
                       ClassMethod::name('getSomething')
                            ->addParam(
                                Params::name('year')
                                    ->setType('int')
                                    ->setDefaultFalse()

                            )->makePublic()
                            ->addMethodBody(
                                Variable::fetch('ssa', 'good')
                            )

                           ->addMethodBody(
                               Variable::fetch('ssa', '1')
                           )
                           ->call('this', 'getmethod')
                           ->call(null, 'goods', [new MethodCall(
                               'this', 'bad'
                           )])
                           ->return()
                    )->fetch());

        dd($output);
    }


    protected function classMethod()
    {}

}