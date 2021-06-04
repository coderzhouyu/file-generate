<?php
namespace JaguarJack\Generate\Build;

use JaguarJack\Generate\Exceptions\OperatorNotFoundException;
use JaguarJack\Generate\Operator\Coalesce;

/**
 * operator
 *
 * @method static concat($left, $right)
 * @method static div($left, $right)
 * @method static minus($left, $right)
 * @method static mod($left, $right)
 * @method static mul($left, $right)
 * @method static plus($left, $right)
 * @method static coalesce($left, $right)
 * @method static assignCoalesce($left, $right)
 * @method static assignConcat($left, $right)
 * @method static assignPlus($left, $right)
 * @method static assignDiv($left, $right)
 * @method static assignMinus($left, $right)
 * @method static assignMod($left, $right)
 * @method static assignMul($left, $right)
 * @method static smaller($left, $right)
 * @method static equal($left, $right)
 * @method static greater($left, $right)
 * @method static identical($left, $right)
 * @method static greaterOrEqual($left, $right)
 * @method static notEqual($left, $right)
 * @method static notIdentical($left, $right)
 * @method static smallerOrEqual($left, $right)
 *
 * @time 2021年06月04日
 */
class Operator
{
    /**
     * 静态访问
     *
     * @time 2021年06月04日
     * @param $method
     * @param $args
     * @return mixed
     * @throws OperatorNotFoundException
     */
    public static function __callStatic($method, $args)
    {
        if (strpos($method, 'assign') === 0) {
            $operator = self::getOperator(str_replace('assign', '', $method))->assign();
        } else {
            $operator = self::getOperator($method);
        }

        return $operator->fetch(...$args);
    }


    /**
     * get operate
     *
     * @time 2021年06月04日
     * @param $name
     * @throws OperatorNotFoundException
     * @return mixed
     */
    protected static function getOperator($name)
    {
        $class = '\\JaguarJack\\Generate\\Operator\\' . ucfirst($name);

        if ( !class_exists($class)) {
            throw new OperatorNotFoundException();
        }

        return new $class;
    }

}