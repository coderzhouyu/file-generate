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
    protected function operate(): string
    {
        // TODO: Implement operate() method.
        if ($this->assign) {
            return \PhpParser\Node\Expr\AssignOp\Plus::class;
        }

        return \PhpParser\Node\Expr\BinaryOp\Plus::class;
    }
}