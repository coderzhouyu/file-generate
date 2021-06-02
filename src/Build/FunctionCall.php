<?php

namespace JaguarJack\Generate\Build;

use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;

class FunctionCall extends FuncCall
{
    /**
     * function name
     *
     * @time 2021年06月01日
     * @param string $name
     * @return FunctionCall
     */
    public static function name(string $name): FunctionCall
    {
        return new self(new Name($name));
    }

    /**
     * args
     *
     * @time 2021年06月02日
     * @param ...$args
     * @return $this
     */
    public function args(...$args): FunctionCall
    {
        foreach ($args as $arg) {
            $this->args[] = Value::fetch($arg);
        }

        return $this;
    }

}