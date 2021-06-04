<?php
namespace JaguarJack\Generate\Block;


use PhpParser\Node\Stmt\Else_;

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
     * fetch else if
     *
     * @time 2021年06月04日
     * @return void
     */
   protected function fetchElseIf()
   {
       $elseCount = count($this->elseif);

       if ($elseCount) {
           $elseif = array_pop($this->elseif);

           while (count($this->elseif)) {
               $endElse = array_pop($this->elseif);

               $endElse->else = $elseif;

               $elseif = $endElse;
           }

           $this->if->else = $elseif;
       }
   }

    /**
     * if
     *
     * @time 2021年06月04日
     * @param array $body
     * @return If_
     */
    public function block(array $body)
    {
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