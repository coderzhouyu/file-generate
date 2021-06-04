<?php
namespace JaguarJack\Generate\Operator;

/**
 * $a - $b
 *
 * Class Concat
 * @package JaguarJack\Generate\Operator
 * @author CatchAdmin
 * @time 2021年06月03日
 */
class Minus extends Base
{
    protected function operate(): string
    {
        // TODO: Implement operate() method.
        if ($this->assign) {
            return \PhpParser\Node\Expr\AssignOp\Minus::class;
        }

        return \PhpParser\Node\Expr\BinaryOp\Minus::class;
    }
}