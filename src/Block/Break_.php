<?php
namespace JaguarJack\Generate\Block;

use JaguarJack\Generate\Build\Value;
use PhpParser\Node;

class Break_ extends \PhpParser\Node\Stmt\Break_
{
    public function __construct(Node\Expr $num = null, array $attributes = [])
    {
        parent::__construct(
            $num instanceof Node\Expr ? $num : Value::fetch($num),
            $attributes
        );
    }
}