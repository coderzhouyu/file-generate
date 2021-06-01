<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use PHPUnit\Framework\TestCase;

class DefineClassTest extends TestCase
{

    public function testClass()
    {
        $class = Class_::name('Test')->fetch();

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrint([$class]), $this->class());

    }

    public function testClassExtends()
    {
        $class = Class_::name('Test')->extend('Base')->fetch();

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrint([$class]), $this->classExtends());

    }

    public function testClassImplement()
    {
        $class = Class_::name('Test')->implement('Base', 'Bases')->fetch();

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrint([$class]), $this->classImplement());

    }

    protected function class()
    {
        return <<<PHP
class Test
{
}
PHP;

    }

    protected function classExtends()
    {
        return <<<PHP
class Test extends Base
{
}
PHP;

    }

    protected function classImplement()
    {
        return <<<PHP
class Test implements Base, Bases
{
}
PHP;

    }

}