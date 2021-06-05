<?php
namespace JaguarJack\Generate\Block;

class Elseif_
{
    protected static $elseif;

    /**
     * condition
     *
     * @time 2021年06月04日
     * @param $condition
     * @return Elseif_
     */
    public static function condition($condition): Elseif_
    {
        self::$elseif = new \PhpParser\Node\Stmt\ElseIf_($condition);

        return new self;
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
        self::$elseif->stmts = $stmt;

        return self::$elseif;
    }
}