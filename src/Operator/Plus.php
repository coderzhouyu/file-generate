<?php
namespace JaguarJack\Generate\Operator;

/**
 * $a + $b
 *
 * Class Concat
 * @package JaguarJack\Generate\Operator
 * @author CatchAdmin
 * @time 2021年06月03日
 */
class Plus extends Base
{
    protected static function operate()
    {
        // TODO: Implement operate() method.

        return \PhpParser\Node\Expr\BinaryOp\Plus::class;
    }
}