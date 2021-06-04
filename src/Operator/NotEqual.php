<?php
namespace JaguarJack\Generate\Operator;

/**
 * $a <> $b
 *
 * Class NotEqual
 * @package JaguarJack\Generate\Operator
 * @author CatchAdmin
 * @time 2021年06月03日
 */
class NotEqual extends Base
{
    protected function operate(): string
    {
        // TODO: Implement operate() method.
        return \PhpParser\Node\Expr\BinaryOp\NotEqual::class;
    }
}