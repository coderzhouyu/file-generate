<?php

namespace JaguarJack\Generate\Build;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

class MethodCall extends \PhpParser\Node\Expr\MethodCall
{
    public function __construct($var, $name, array $args = [], array $attributes = [])
    {
        parent::__construct(
            is_string($var) ? new Expr\Variable($var) : $var,
            new Identifier($name),
            self::parseArgs($args),
            $attributes
        );
    }

    /**
     * 静态方法
     *
     * @time 2021年06月02日
     * @param $class
     * @param $name
     * @param array $args
     * @return Expr\StaticCall
     */
    public static function staticCall($class, $name, $args = []): Expr\StaticCall
    {
        return new Expr\StaticCall(
            new Name($class),
            $name,
            self::parseArgs($args)
        );
    }

    /**
     *
     * @time 2021年06月06日
     * @param $args
     * @return mixed
     */
    protected static function parseArgs($args)
    {
        foreach ($args as $k => $arg) {
            if (is_string($arg)) {
                $args[$k] = new Arg(new Variable($arg));
            } elseif ($arg instanceof Params) {
                $args[$k] = $arg->fetch();
            } else {

            }
        }

        return $args;
    }
}