<?php
namespace JaguarJack\Generate\Types;

use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Name;

class Boolean_ extends ConstFetch
{
    public function __construct($bool, array $attributes = [])
    {
        parent::__construct(new Name($bool ? 'true' : 'false'), $attributes);
    }
}