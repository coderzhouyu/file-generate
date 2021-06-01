<?php
namespace Test;

use JaguarJack\Generate\Build\Class_;
use JaguarJack\Generate\Build\Namespace_;
use PHPUnit\Framework\TestCase;

class DefineNamespaceTest extends TestCase
{
    public function testNamespace()
    {
        $output = Standard::output(
            Namespace_::name('Test')->fetch()
        );

        $this->assertEquals($output, $this->namespace());
    }


    public function testUseNamespace()
    {
        $output = Standard::output(
            Namespace_::name('Test')
                ->useUse('App\\Http as H')
                ->fetch()
        );

        $this->assertEquals($output, $this->useNamespace());
    }


    public function testNamespaceWithClass()
    {
        $output = Standard::output(
            Namespace_::name('Test')
                ->useClass(
                    Class_::name('Has')
                )
                ->fetch()
        );

        $this->assertEquals($output, $this->namespaceWithClass());
    }


    protected function namespaceWithClass()
    {
        return <<<PHP
namespace Test;

class Has
{
}
PHP;

    }

    protected function useNamespace()
    {
        return <<<PHP
namespace Test;

use App\Http  as  H;
PHP;
    }
    protected function namespace()
    {
        return <<<PHP
namespace Test;

PHP;

    }
}