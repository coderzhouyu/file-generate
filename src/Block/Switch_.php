<?php

namespace JaguarJack\Generate\Block;

use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Case_;
use PhpParser\Node\Stmt\Return_;

class Switch_
{
    protected $cases = [];

    protected $condition;

    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    /**
     * case 集合
     *
     * @time 2021年06月04日
     * @param array $case
     * @return $this
     */
    public function cases(array $case)
    {
        $this->cases = $case;

        return $this;
    }

    /**
     * fetch
     *
     * @time 2021年06月04日
     * @return \PhpParser\Node\Stmt\Switch_
     */
    public function fetch(): \PhpParser\Node\Stmt\Switch_
    {
        return new \PhpParser\Node\Stmt\Switch_($this->condition, $this->cases);
    }

    /**
     * case condition
     *
     * @time 2021年06月04日
     * @param $result
     * @param array $block
     * @param bool $break
     * @param false $return
     * @return Case_
     */
    public static function case($result, array $block, $break = true, $return = false)
    {
        if ($break) {
            $block[] = new Break_();
        }

        if ($return) {
            if ($break) {
                $break = array_pop($block);
            }

            array_push($block, new Return_(array_pop($block)));

            array_push($block, $break);
        }

        return new Case_($result, $block);
    }
}