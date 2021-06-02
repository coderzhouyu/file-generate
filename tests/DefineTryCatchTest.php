<?php
namespace Test;

use JaguarJack\Generate\Build\Exception;
use JaguarJack\Generate\Build\TryCatch;
use JaguarJack\Generate\Build\Variable;
use PHPUnit\Framework\TestCase;

class DefineTryCatchTest extends TestCase
{

    public function testTryCatch()
    {
        $tryCatch = new TryCatch();

        $t = $tryCatch->catch(['FailedException', 'Exception'], 'e')->fetch();

        $this->assertEquals(Standard::output($t), $this->tryCatch());
    }


    protected function tryCatch()
    {
        return <<<PHP
try {
} catch (\FailedException|\Exception \$e) {
}
PHP;

    }





    public function testTryCatchWithBody()
    {
        $tryCatch = new TryCatch();

        $t = $tryCatch
            ->catch(['FailedException', 'Exception'], 'e')
            ->body([
                Variable::fetch('a', 123),

                Exception::throw('Exception', 'goods')
            ])
            // ->return()
            ->fetch();

        $this->assertEquals(Standard::output($t), $this->tryCatchWithBody());
    }


    protected function tryCatchWithBody()
    {
        return <<<PHP
try {
    \$a = 123;
    throw new Exception('goods');
} catch (\FailedException|\Exception \$e) {
}
PHP;
    }


    public function testCatchBody()
    {
        $tryCatch = new TryCatch();

        $t = $tryCatch
            ->catch(['FailedException', 'Exception'],
                'e',
                function () {
                    return [
                        Variable::fetch('a', 'catchBody'),
                        new Variable('a')
                    ];
                }, true
            )

            ->fetch();

        $this->assertEquals(Standard::output($t), $this->catchBody());
    }


    protected function catchBody()
    {
        return <<<PHP
try {
} catch (\FailedException|\Exception \$e) {
    \$a = 'catchBody';
    return \$a;
}
PHP;

    }

    public function testTryCatchFinally()
    {
        $tryCatch = new TryCatch();

        $t = $tryCatch
            ->finally(
                function () {
                    return [
                        Variable::fetch('a', 'catchBody'),
                        new \PhpParser\Node\Expr\Variable('a')
                    ];
                }, true
            )
            ->fetch();

        $this->assertEquals(Standard::output($t), $this->tryCatchFinally());
    }


    protected function tryCatchFinally()
    {
        return <<<PHP
try {
} finally {
    \$a = 'catchBody';
    return \$a;
}
PHP;

    }
}