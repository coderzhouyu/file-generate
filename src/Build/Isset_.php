<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Node\Expr;

class Isset_ extends \PhpParser\Node\Expr\Isset_
{
    public function __construct(...$vars)
    {
        $params = [];

        foreach ($vars as $var) {
            $params[] = $var instanceof Expr ? $var : new Variable($var);
        }

        parent::__construct($params, [

        ]);
    }
}