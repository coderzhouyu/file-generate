<?php
namespace Test;


use JaguarJack\Generate\Build\Assign;
use JaguarJack\Generate\Build\Closure;
use JaguarJack\Generate\Build\MethodCall;
use JaguarJack\Generate\Build\Property;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;

class DefineAssignTest extends TestCase
{
    public function testPropertyAssign()
    {
        $assign = (new Assign(
            Property::defineIdentifier('request', 'role'),
            new Variable('role')
        ))->fetch();


       $this->assertEquals(Standard::output($assign), $this->propertyAssign());
    }


    public function testMethodClassAssign()
    {
        $assign = new Assign(
            Property::defineIdentifier('request', 'role'),

            new MethodCall(new MethodCall('this', 'get'), 'Get', [

            ])
        );

        $this->assertEquals(Standard::output($assign), $this->methodClassAssign());

    }


    protected function methodClassAssign()
    {
        return <<<PHP
\$request->role = \$this->get()->Get()
PHP;

    }


    protected function propertyAssign()
    {
        return <<<PHP
\$request->role = \$role;
PHP;

    }
}