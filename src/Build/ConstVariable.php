<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Comment\Doc;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Const_;
use PhpParser\Node\Stmt\Expression;

class ConstVariable
{
    /**
     * fetch
     *
     * @time 2021年05月31日
     * @param $variableName
     * @param $variableValue
     * @param null $document
     * @return Const_|Expression
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     */
    public static function fetch($variableName, $variableValue = null, $document = null)
    {

        $const = new Const_([
            new \PhpParser\Node\Const_(
                new Identifier($variableName),
                Value::fetch($variableValue)
            )
        ]);

        if ($document) {
            $const->setDocComment(new Doc($document));
        }

        return $const;
    }
}