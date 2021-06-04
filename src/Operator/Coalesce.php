<?php
namespace JaguarJack\Generate\Operator;

class Coalesce extends Base
{
    protected function operate()
    {
        // TODO: Implement operate() method.
        if ($this->assign) {
            return \PhpParser\Node\Expr\AssignOp\Coalesce::class;
        }

        return \PhpParser\Node\Expr\BinaryOp\Coalesce::class;
    }
}