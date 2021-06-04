<?php
namespace JaguarJack\Generate\Operator;

/**
 * $a <= $b
 *
 * Class SmallerOrEqual
 * @package JaguarJack\Generate\Operator
 * @author CatchAdmin
 * @time 2021年06月03日
 */
class SmallerOrEqual extends Base
{
    protected function operate(): string
    {
        // TODO: Implement operate() method.
        return \PhpParser\Node\Expr\BinaryOp\SmallerOrEqual::class;
    }
}