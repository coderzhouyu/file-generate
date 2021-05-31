<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Comment\Doc;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Stmt\Expression;

class Variable
{
    /**
     * fetch
     *
     * @time 2021年05月31日
     * @param $variableName
     * @param $variableValue
     * @param null $document
     * @return Expression
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     */
    public static function fetch($variableName, $variableValue = null, $document = null)
    {
        $expression = new Expression(
            new Assign(
                new \PhpParser\Node\Expr\Variable($variableName),
                Value::fetch($variableValue)
            )
        );

        if ($document) {
            $expression->setDocComment(new Doc($document));
        }

        return $expression;
    }
}