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


    protected function string()
    {
        return <<<PHP
<?php

const a = 'this is a string';
PHP;

    }

}