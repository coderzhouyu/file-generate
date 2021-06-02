<?php
namespace Test;

use JaguarJack\Generate\Build\Assign;
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
        $output = Standard::output(
            Class_::name('Test')
                    ->useMethod(
                       ClassMethod::name('getSomething')
                            ->addParam(
                                Params::name('year')
                            )->makeProtected()
                            ->body([
                                Variable::fetch('ssa', '1'),

                                Variable::fetch('ssa', '1'),

                                Variable::fetch('asd', new MethodCall(MethodCall::staticCall('self', 'get'), 'Good')),

                                new Variable('asd')
                            ])
                           ->return()
                    )
                ->fetch()
        );

        $this->assertEquals($output, $this->classMethod());
    }


    protected function classMethod()
    {
        return <<<PHP
class Test
{
    protected function getSomething(\$year)
    {
        \$ssa = '1';
        \$ssa = '1';
        \$asd = self::get()->Good();
        return \$asd;
    }
}
PHP;

    }

}