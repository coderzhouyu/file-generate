<?php

namespace Test;

use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;

class DefineVariableTest extends TestCase
{
    /**
     * @test
     */
    public function testDone()
    {
        $res = Variable::fetch('a', 'b');

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrintFile([$res]), $this->result());
    }


    
    protected function result()
    {
        return <<<PHP
<?php

\$a = 'b';
PHP;

    }

}