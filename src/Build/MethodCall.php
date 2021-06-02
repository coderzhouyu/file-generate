<?php

namespace JaguarJack\Generate\Build;


use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

class MethodCall extends \PhpParser\Node\Expr\MethodCall
{
    public function __construct($var, $name, array $args = [], array $attributes = [])
    {
        foreach ($args as $k => $arg) {
            if (is_string($arg)) {
                $args[$k] = new Arg(new Variable($arg));
            }
        }

        parent::__construct(
            is_string($var) ? new Expr\Variable($var) : $var,
            new Identifier($name),
            $args,
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

            $name, $args);
    }
}