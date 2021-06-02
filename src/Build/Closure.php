<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Node\Expr\ClosureUse;
use PhpParser\Node\Stmt\Return_;

class Closure extends \PhpParser\Node\Expr\Closure
{
    protected $body;

    /**
     * 添加参数
     *
     * @time 2021年06月02日
     * @param ...$params
     * @return $this
     */
    public function addParams(...$params): Closure
    {
        foreach ($params as $param) {
            if ($param instanceof Params) {
                $this->params[] = $param->fetch();
            } else {
                $this->params[] = Params::name($param)->fetch();
            }
        }

        return $this;
    }

    /**
     * uses
     *
     * @time 2021年06月02日
     * @param ...$params
     * @return $this
     */
    public function uses(...$params): Closure
    {
        foreach ($params as $param) {
            $this->uses[] = new ClosureUse(
                new \PhpParser\Node\Expr\Variable($param)
            );
        }

        return $this;
    }

    /**
     * 方法返回
     *
     * @time 2021年06月02日
     * @return Closure
     */
    public function return(): Closure
    {
        $last = new Return_($this->stmts[count($this->stmts)-1]);

        $this->stmts[count($this->stmts)-1] = $last;

        return $this;
    }

    /**
     * 添加方法体
     *
     * @time 2021年06月01日
     * @param array $stmts
     * @return ClassMethod|Closure
     */
    public function body(array $stmts)
    {
        $this->stmts = $stmts;

        return $this;
    }
}