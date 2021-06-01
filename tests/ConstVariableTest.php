<?php

namespace Test;

use JaguarJack\Generate\Build\ConstVariable;
use PHPUnit\Framework\TestCase;

class ConstVariableTest extends TestCase
{
    public function testString()
    {
        $res = ConstVariable::fetch('a', 'this is a string');

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrintFile([$res]), $this->string());
    }

    public function testArray()
    {
        $res = ConstVariable::fetch('a', ['this is a array']);

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrintFile([$res]), $this->array());
    }

    public function testBoolean()
    {
        $res = ConstVariable::fetch('a',true);

        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        $this->assertEquals($prettyPrinter->prettyPrintFile([$res]), $this->boolean());
    }

    protected function boolean()
    {
        return <<<PHP
<?php

const a = true;
PHP;

    }


    protected function array()
    {
        return <<<PHP
<?php

const a = array('this is a array');
PHP;
    }

    protected function string()
    {
        return <<<PHP
<?php

const a = 'this is a string';
PHP;

    }

}