<?php
namespace JaguarJack\Generate\Operator;

/**
 * $a . $b
 *
 * Class Concat
 * @package JaguarJack\Generate\Operator
 * @author CatchAdmin
 * @time 2021年06月03日
 */
class Concat extends Base
{
    protected function operate(): string
    {
        // TODO: Implement operate() method.
        if ($this->assign) {
            return \PhpParser\Node\Expr\AssignOp\Concat::class;
        }

        return \PhpParser\Node\Expr\BinaryOp\Concat::class;
    }
}