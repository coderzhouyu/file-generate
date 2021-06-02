<?php
namespace JaguarJack\Generate\Build;


use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Throw_;

class Exception
{
    /**
     * fetch
     *
     * @time 2021年06月02日
     * @param $names
     * @return array
     */
    public static function fetch($names): array
    {
        $types = [];

        if (is_string($names)) {
            $types[] = new Name\FullyQualified($names);
        } else {
            foreach ($names as $name) {
                $types[] = new Name\FullyQualified($name);
            }
        }

        return $types;
    }

    /**
     * throw exception
     *
     * @time 2021年06月02日
     * @param string $name
     * @param array $args
     * @return Throw_
     */
    public static function throw(string $name, ...$args)
    {
        $_args = [];

        foreach ($args as $arg) {
            $_args[] = Value::fetch($arg);
        }

        return new Throw_(
            new New_(
                new Name($name),
                $_args
            ),
        );
    }
}