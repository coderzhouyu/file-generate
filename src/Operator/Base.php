<?php
namespace JaguarJack\Generate\Operator;


use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Variable;

abstract class Base
{
    abstract protected static function operate();

    /**
     * fetch
     *
     * @author CatchAdmin
     * @time 2021年06月03日
     * @param $left
     * @param $right
     * @return mixed
     */
    public static function fetch($left, $right)
    {
        $left = $left instanceof Expr ? $left : new Variable($left);

        $right = $right instanceof Expr ? $right : new Variable($right);

        $operate = static::operate();

        return new $operate($left, $right);
    }
}