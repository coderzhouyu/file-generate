<?php

namespace JaguarJack\Generate\Build;


use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;

class MethodCall extends \PhpParser\Node\Expr\MethodCall
{
    public function __construct($var, $name, array $args = [], array $attributes = [])
    {
        parent::__construct(
            is_string($var) ? new Expr\Variable($var) : $var,
            new Identifier($name),
            $args,
            $attributes
        );
    }
}