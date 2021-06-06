<?php
namespace JaguarJack\Generate;

use JaguarJack\Generate\Build\Class_;
use JaguarJack\Generate\Build\ClassMethod;
use JaguarJack\Generate\Build\MethodCall;
use JaguarJack\Generate\Build\Namespace_;
use JaguarJack\Generate\Build\Property;
use JaguarJack\Generate\Exceptions\GenerateFailedExceptions;
use PhpParser\PrettyPrinter\Standard;

class Generator
{
    /**
     * @var string
     */
    protected static $namespace;

    /**
     * @var array
     */
    protected $uses;

    /**
     * @var Class_
     */
    protected $class;


    /**
     * 方法调用
     *
     * @var array
     */
    protected $call = null;

    /**
     * 命名空间
     *
     * @time 2021年06月06日
     * @param string $namespace
     * @return Generator
     */
    public static function namespace(string $namespace)
    {
        static::$namespace = $namespace;

        return new self;
    }

    /**
     * uses 集合
     *
     * @time 2021年06月06日
     * @param array $uses
     * @return $this
     */
    public function uses(array $uses)
    {
        $this->uses = $uses;

        return $this;
    }

    /**
     * class
     *
     * @time 2021年06月06日
     * @param string $className
     * @param \Closure $closure
     * @return $this
     */
    public function class(string $className, \Closure $closure = null)
    {
        $this->class = Class_::name($className)->setDocComment($this->gap());

        if ($closure) {
            $closure($this->class, $this);
        }

        return $this;
    }

    /**
     * 属性
     *
     * @time 2021年06月06日
     * @param string $name
     * @param \Closure|null $closure
     * @throws Exceptions\TypeNotFoundException
     * @return void
     */
    public function property(string $name, \Closure $closure = null)
    {
        $property = Property::name($name)->setDocComment($this->gap());

        if (! $closure) {
            $this->class->useProperty($property->makePublic());
        } else {
            $this->class->useProperty($closure($property));
        }
    }

    /**
     * 方法
     *
     * @time 2021年06月06日
     * @param string $name
     * @param \Closure|null $closure
     * @throws Exceptions\TypeNotFoundException
     * @return void
     */
    public function method(string $name, \Closure $closure = null)
    {
        $method = ClassMethod::name($name)->setDocComment($this->gap());

        if (! $closure) {
            $this->class->useMethod($method->makePublic());
        } else {
            $this->class->useMethod($closure($method, $this));
        }
    }

    /**
     * traits
     *
     * @time 2021年06月06日
     * @param array $traits
     * @return void
     */
    public function traits(array $traits)
    {
        $this->uses = array_merge($this->uses, $traits);

        $this->class->useTrait(...$traits);
    }

    /**
     * class const
     *
     * @time 2021年06月06日
     * @param $name
     * @param $value
     * @throws Exceptions\TypeNotFoundException
     * @return void
     */
    public function const($name, $value)
    {
        $this->class->useConst($name, $value);
    }

    /**
     * 打印
     *
     * @time 2021年06月06日
     * @return string
     *@throws \Exception
     */
    public function print()
    {
        $standard = new Standard();

        return $standard->prettyPrintFile([
            Namespace_::name(self::$namespace)
                ->useUse(...$this->uses)
                ->useClass($this->class)
                ->fetch()
        ]);
    }

    /**
     * file generate
     *
     * @time 2021年06月06日
     * @param $filename
     * @param string $path
     * @throws \JaguarJack\Generate\Exceptions\GenerateFailedExceptions
     * @return bool
     */
    public function file($filename, $path = './')
    {
        $file = $path . $filename . '.php';

        file_put_contents($file, $this->print());

        if (! file_exists($file)) {
            throw new GenerateFailedExceptions($file . ' generate failed');
        }

        return true;
    }

    /**
     * 方法
     *
     * @time 2021年06月06日
     * @param $name
     * @param string $class
     * @param array $args
     * @return MethodCall
     */
    public function methodCall($name, $args = [], $class = 'this')
    {
        return new MethodCall($class, $name, $args);
    }

    /**
     * 静态方法
     *
     * @time 2021年06月06日
     * @param $name
     * @param string $class
     * @param array $args
     * @return \PhpParser\Node\Expr\StaticCall
     */
    public function staticMethodCall($name, $args = [], $class = 'self')
    {
        return MethodCall::staticCall($class, $name, $args);
    }

    /**
     * 方法调用
     *
     * @time 2021年06月06日
     * @return array|Generator
     */
    public function call(string $method = null, $args = [], $class = 'this')
    {
        if ($method) {
            $callMethod = $class === 'this' ? 'methodCall' : 'staticMethodCall';

            if (!$this->call) {
                $this->call = $this->{$callMethod}($method, $args, $class);
            } else {
                $this->call = $this->{$callMethod}($method, $args, $this->call);
            }


            return $this;
        } else {
            return $this->call;
        }
    }


    /**
     * 分割
     *
     * @time 2021年06月06日
     * @return string
     */
    protected function gap()
    {
        return PHP_EOL;
    }

}