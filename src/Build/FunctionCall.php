<?php

namespace JaguarJack\Generate\Build;

use PhpParser\Builder\Function_;
use PhpParser\Node\Name;

class FunctionCall extends Function_
{
    /**
     * function name
     *
     * @time 2021年06月01日
     * @param string $name
     * @return FunctionCall
     */
    public static function name(string $name)
    {
        return new self($name);
    }


    public function args(...$args)
    {

    }

}