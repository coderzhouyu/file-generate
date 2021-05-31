<?php
namespace JaguarJack\Generate\Types;

use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Name;

class Null_ extends ConstFetch
{
    public function __construct($name = null, array $attributes = [])
    {
        parent::__construct(new Name('null'), $attributes);
    }
}