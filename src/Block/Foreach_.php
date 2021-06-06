<?php
namespace JaguarJack\Generate\Block;

use JaguarJack\Generate\Build\Variable;
use PhpParser\Node;

class Foreach_
{
    protected $expr;

    protected $k;

    protected $value;

    protected $isRef;

    protected $block;

    /**
     * Foreach_ constructor.
     * @param string $exr // array variable
     * @param $value // array value
     * @param null $k // array key
     */
    public function __construct(string $exr, $value, $k = null)
    {
       $this->expr = $exr;

       $this->value = $value;

       $this->k = $k;
    }

    /**
     *
     * @time 2021年06月06日
     * @return Node\Stmt\Foreach_
     */
    public function fetch(): Node\Stmt\Foreach_
    {
        $subNodes = [];

        if ($this->isRef) {
            $subNodes['byRef'] = $this->isRef;
        }

        if ($this->k) {
            $subNodes['keyVar'] = new Variable($this->k);
        }

        if ($this->block) {
            $subNodes['stmts'] = $this->block;
        }

        return new Node\Stmt\Foreach_(
            new Variable($this->expr),
            new Variable($this->value),
            $subNodes,
        );
    }

    /**
     * 主体
     *
     * @time 2021年06月04日
     * @param array $stmts
     * @return $this
     */
    public function block(array $stmts): Foreach_
    {
        $this->block = $stmts;

        return $this;
    }

    /**
     *
     * @time 2021年06月04日
     * @return $this
     */
    public function refValue(): Foreach_
    {
        $this->isRef = true;

        return $this;
    }
}