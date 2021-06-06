<?php
namespace JaguarJack\Generate\Operator;

use JaguarJack\Generate\Exceptions\InvalidArgumentException;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Variable;

abstract class Base
{
    protected $assign = false;

    /**
     *
     * @time 2021年06月04日
     * @return mixed
     */
    abstract protected function operate();

    /**
     *
     * @time 2021年06月04日
     * @return $this
     */
    public function assign()
    {
        $this->assign = true;

        return $this;
    }

    /**
     * fetch
     *
     * @param mixed ...$args
     * @return mixed
     * @throws InvalidArgumentException
     * @author CatchAdmin
     * @time 2021年06月03日
     */
    public function fetch(...$args)
    {
        $argsNumber = count($args);

        $operate = $this->operate();

        if ($argsNumber === 2) {
            list($left, $right) = $args;

            $left = $left instanceof Expr ? $left : new Variable($left);

            $right = $right ? ($right instanceof Expr ? $right : new Variable($right)) : null;

            return new $operate($left, $right);
        }

        if ($argsNumber === 1) {
            $arg = $args[0] instanceof Expr ? $args[0] : new Variable($args[0]);

            return new $operate($arg);
        }

        throw new InvalidArgumentException();
    }
}