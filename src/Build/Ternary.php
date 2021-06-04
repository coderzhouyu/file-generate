<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Node\Expr;

class Ternary extends \PhpParser\Node\Expr\Ternary
{
    public function __construct($cond, $if, $else, array $attributes = [])
    {
        parent::__construct($cond instanceof Expr ? $cond : new Variable($cond),
            $if instanceof Expr ? $if : Value::fetch($if),
            $if instanceof Expr ? $else : Value::fetch($else),
            $attributes
        );
    }
}