<?php
namespace JaguarJack\Generate\Build;


use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ArrayDimFetch;

class ArrayFetch extends ArrayDimFetch
{
    public function __construct($var, $dim = null, array $attributes = [])
    {
        parent::__construct($var instanceof Expr ? $var : new Variable($var), Value::fetch($dim), $attributes);
    }
}