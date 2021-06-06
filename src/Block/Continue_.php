<?php
namespace JaguarJack\Generate\Block;

use JaguarJack\Generate\Build\Value;
use PhpParser\Node;

class Continue_ extends \PhpParser\Node\Stmt\Continue_
{
    public function __construct(Node\Expr $num = null, array $attributes = [])
    {
        parent::__construct(
            $num instanceof Node\Expr ? $num : Value::fetch($num),
            $attributes);
    }
}