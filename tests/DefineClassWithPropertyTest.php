<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use JaguarJack\Generate\Build\Property;
use PHPUnit\Framework\TestCase;

class DefineClassWithPropertyTest extends TestCase
{
    public function testClassWithProperty()
    {
        $output = Standard::output(Class_::name('Test')
                        ->useProperty(
                            Property::name('name')
                            ->makeStatic()
                            ->makeProtected()
                            ->setDocComment('// good')
                            ->setType('int')
                        )
                        ->fetch());

        $this->assertEquals($output, $this->classWithProperty());
    }

    protected function classWithProperty()
    {
        return <<<PHP
class Test
{
    // good
    protected static int \$name;
}
PHP;

    }

}