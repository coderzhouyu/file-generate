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
     * @return Elseif_|\PhpParser\Node\Stmt\ElseIf_
     */
    public static function condition($condition)
    {
        self::$elseif = new \PhpParser\Node\Stmt\ElseIf_($condition);

        return new self;
    }

    public function block(array $stmt)
    {
        self::$elseif->stmts = $stmt;

        return self::$elseif;
    }
}