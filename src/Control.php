<?php
namespace JaguarJack\Generate;

use JaguarJack\Generate\Block\Break_;
use JaguarJack\Generate\Block\Continue_;
use JaguarJack\Generate\Block\Elseif_;
use JaguarJack\Generate\Block\Foreach_;
use JaguarJack\Generate\Block\If_;
use JaguarJack\Generate\Block\Switch_;
use JaguarJack\Generate\Block\While_;

/**
 * @method static If_ if($condition)
 * @method static Foreach_  foreach(string $exr, $value, $k = null)
 * @method static While_ while($condition)
 * @method static Switch_ switch($condition)
 * @method static Break_ break($num)
 * @method static Continue_ continue($num)
 * @method static Elseif_ elseif($condition)
 *
 * @time 2021年06月06日
 */
class Control
{
    /**
     * case
     *
     * @time 2021年06月06日
     * @param $result
     * @param array $block
     * @param bool $break
     * @param false $return
     * @return \PhpParser\Node\Stmt\Case_
     */
    public static function case($result, array $block, $break = true, $return = false)
    {
        return Switch_::case($result, $block, $break, $return);
    }

    /**
     * static visit
     *
     * @time 2021年06月06日
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $class = self::getControl($method);

        return new $class(...$args);
    }

    protected static function getControl($method)
    {
        return __NAMESPACE__ . '\\Block\\' . ucfirst($method). '_';
    }
}