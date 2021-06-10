<?php
namespace JaguarJack\Generate\Build;


use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

class ClassConstFetch extends \PhpParser\Node\Expr\ClassConstFetch
{
    public function __construct($class, $name, array $attributes = [])
    {
        parent::__construct(new Name($class), new Identifier($name), $attributes);
    }
}