<?php
namespace JaguarJack\Generate\Operator;


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
     * @author CatchAdmin
     * @time 2021年06月03日
     * @param $left
     * @param $right
     * @return mixed
     */
    public function fetch($left, $right)
    {
        $left = $left instanceof Expr ? $left : new Variable($left);

        $right = $right instanceof Expr ? $right : new Variable($right);

        $operate = $this->operate();

        return new $operate($left, $right);
    }
}