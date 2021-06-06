<?php
namespace JaguarJack\Generate\Block;

class Elseif_
{
    protected $elseif;

    /**
     * condition
     *
     * @time 2021年06月04日
     * @param $condition
     * @return void
     */
    public function __construct($condition)
    {
        $this->elseif = new \PhpParser\Node\Stmt\ElseIf_($condition);
    }

    /**
     * else if
     *
     * @author CatchAdmin
     * @time 2021年06月05日
     * @param array $stmt
     * @return mixed
     */
    public function block(array $stmt)
    {
        if (! count($stmt)) {
            return $this->elseif;
        }

        $this->elseif->stmts = $stmt;

        return $this->elseif;
    }
}