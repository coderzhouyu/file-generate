<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use PHPUnit\Framework\TestCase;

class DefineClassWithTraitTest extends TestCase
{
    public function testClassWithTrait()
    {
        $output = Standard::output(
            Class_::name('Test')
                ->useTrait('testTrait::play insteadof test', 'hello::play as good')
                ->fetch()
        );

        $this->assertEquals($output, $this->classWithTrait());
    }


    public function classWithTrait()
    {
        return <<<PHP
class Test
{
    use testTrait, hello {
        testTrait::play  insteadof  test;
        hello::play  as  good;
    }
}
PHP;

    }
}