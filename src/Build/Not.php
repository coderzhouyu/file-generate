<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BooleanNot;

class Not extends BooleanNot
{
    public function __construct($variable, array $attributes = [])
    {
        parent::__construct($variable instanceof Expr ? $variable : new Variable($variable), $attributes);
    }
}