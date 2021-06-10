<?php
namespace JaguarJack\Generate;


use JaguarJack\Generate\Build\ConstVariable;
use JaguarJack\Generate\Build\Property;
use JaguarJack\Generate\Build\Value;
use JaguarJack\Generate\Build\Variable;

class Define
{
    /**
     * 定义变量
     *
     * @time 2021年06月06日
     * @param $name
     * @param null $value
     * @param null $document
     * @return Variable|\PhpParser\Node\Stmt\Expression
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     */
    public static function variable($name, $value = null, $document = null)
    {
        if (! $value) {
            return new Variable($name);
        }

        return Variable::fetch($name, $value, $document);
    }

    /**
     * value
     *
     * @time 2021年06月06日
     * @param $value
     * @return mixed
     */
    public static function value($value)
    {
        return Value::fetch($value);
    }

    /**
     * 定义 null
     *
     * @time 2021年06月06日
     * @param $variable
     * @throws Exceptions\TypeNotFoundException
     * @return \PhpParser\Node\Stmt\Expression
     */
    public static function null($variable)
    {
        return Variable::fetch($variable, null);
    }

    /**
     * 常量定义
     *
     * @time 2021年06月06日
     * @param string $variable
     * @param $value
     * @throws Exceptions\TypeNotFoundException
     * @return \PhpParser\Node\Stmt\Const_|\PhpParser\Node\Stmt\Expression
     */
    public static function const(string $variable, $value)
    {
        return ConstVariable::fetch($variable, $value);
    }

    /**
     * 属性访问
     *
     * @time 2021年06月06日
     * @param string $identifier
     * @param string $class
     * @return \PhpParser\Node\Expr\PropertyFetch|mixed
     */
    public static function propertyDefineIdentifier(string $identifier, $class = 'this')
    {
        return Property::defineIdentifier($class, $identifier);
    }

    /**
     * 静态属性
     *
     * @time 2021年06月06日
     * @param string $identifier
     * @param string $class
     * @return \PhpParser\Node\Expr\StaticPropertyFetch
     */
    public static function StaticPropertyDefineIdentifier(string $identifier, $class = 'self')
    {
        return Property::staticDefineIdentifier($class, $identifier);
    }
}
