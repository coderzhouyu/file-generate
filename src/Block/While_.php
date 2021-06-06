<?php

namespace JaguarJack\Generate\Block;

use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Return_;

class While_
{
    protected $condition;


    protected $block;

    public function __construct($condition)
    {
        $this->condition = $condition;
    }

    /**
     * fetch
     *
     * @time 2021年06月04日
     * @return \PhpParser\Node\Stmt\While_
     */
    public function fetch(): \PhpParser\Node\Stmt\While_
    {
        return new \PhpParser\Node\Stmt\While_($this->condition, $this->block);
    }

    /**
     * case condition
     *
     * @time 2021年06月04日
     * @param array $block
     * @return While_
     */
    public function block(array $block): While_
    {
        $this->block = $block;

        return $this;
    }

    /**
     * break while
     *
     * @time 2021年06月06日
     * @return $this
     */
    public function break(): While_
    {
        $this->block[] = new Break_();

        return $this;
    }


    /**
     * break while
     *
     * @time 2021年06月06日
     * @return $this
     */
    public function return(): While_
    {
        $last = array_pop($this->block);

        if ($last instanceof Break_) {
            return $this;
        }

        array_push($this->block, new Return_($last));

        return $this;
    }
}