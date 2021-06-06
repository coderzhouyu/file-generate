<?php
namespace JaguarJack\Generate\Operator;

use PhpParser\Node\Expr\BooleanNot;

class Not extends Base
{
    protected function operate(): string
    {
        return BooleanNot::class;
    }
}