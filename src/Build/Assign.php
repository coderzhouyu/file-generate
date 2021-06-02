<?php
namespace JaguarJack\Generate\Build;


use PhpParser\Node\Stmt\Expression;

class Assign extends \PhpParser\Node\Expr\Assign
{

    /**
     * fetch
     *
     * @time 2021年06月02日
     * @param null $document
     * @return Expression
     */
    public function fetch($document = null): Expression
    {
        $expression = new Expression($this);

        if ($document) {
            $expression->setDocComment($document);
        }

        return $expression;
    }
}