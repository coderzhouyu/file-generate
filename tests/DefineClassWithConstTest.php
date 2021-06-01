<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use PHPUnit\Framework\TestCase;

class DefineClassWithConstTest extends TestCase
{
    public function testClassWithConst()
    {
        $output = Standard::output(
            Class_::name('Test')
                ->useConst([
                    'name'=>'JaguarJack',
                    'good' => 'no'
                ])
                ->fetch()
        );


        $this->assertEquals($output, $this->classWithConst());
    }



    public function classWithConst()
    {
        return <<<PHP
class Test
{
    const NAME = 'JaguarJack';
    const GOOD = 'no';
}
PHP;

    }

}