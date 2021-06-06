<?php
namespace JaguarJack\Generate\Block;


use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\Return_;

class If_
{
    protected $if;

    protected $elseif = [];

    protected $else;

    /**
     * If_ constructor.
     * @param $condition
     *
     */
    public function __construct($condition)
    {
        $this->if = new \PhpParser\Node\Stmt\If_($condition);
    }


    /**
     * fetch
     *
     * @time 2021年06月04日
     * @return \PhpParser\Node\Stmt\If_
     */
   public function fetch(): \PhpParser\Node\Stmt\If_
   {
       $this->if->elseifs = $this->elseif;

       $this->if->else = $this->else;

       return $this->if;
   }

    /**
     * if
     *
     * @time 2021年06月04日
     * @param array $body
     * @param bool $return
     * @return If_
     */
    public function block(array $body, $return = false): If_
    {
        if ($return) {
            array_push($body, new Return_(array_pop($body)));
        }

        $this->if->stmts = $body;

        return $this;
    }

    /**
     * else
     *
     * @time 2021年06月04日
     * @param \PhpParser\Node\Stmt\ElseIf_ $elseif
     * @return $this
     */
    public function elseif(\PhpParser\Node\Stmt\ElseIf_ $elseif): If_
    {
        $this->elseif[] = $elseif;

        return $this;
    }

    /**
     * else
     *
     * @time 2021年06月04日
     * @param array $else
     * @return $this
     */
    public function else(array $else): If_
    {
        $this->elseif[] = new Else_($else);

        return $this;
    }
}