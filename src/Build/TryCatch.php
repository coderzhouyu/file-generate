<?php

namespace JaguarJack\Generate\Build;

use PhpParser\Node\Stmt\Catch_;
use Closure;
use PhpParser\Node\Stmt\Finally_;
use PhpParser\Node\Stmt\Return_;

class TryCatch
{
    protected $body = [];

    protected $catches = [];

    protected $finally;

    /**
     * fetch
     *
     * @time 2021年06月02日
     * @return \PhpParser\Node\Stmt\TryCatch
     */
    public function fetch(): \PhpParser\Node\Stmt\TryCatch
    {
        return new \PhpParser\Node\Stmt\TryCatch(
            $this->body, $this->catches, $this->finally
        );
    }

    /**
     * catch
     *
     * @time 2021年06月02日
     * @param $types
     * @param $variable
     * @param Closure|null $body
     * @param bool $return
     * @return $this
     */
    public function catch($types, $variable, Closure $body = null, $return = false): TryCatch
    {
        $catch = new Catch_(
            Exception::fetch($types), new Variable($variable)
        );

        if ($body) {
            $stmts = $body();

            if ($return) {
                array_push($stmts, new Return_(array_pop($stmts)));
            }

            $catch->stmts = $stmts;
        }

        $this->catches[] = $catch;

        return $this;
    }

    /**
     * finally
     *
     * @time 2021年06月02日
     * @return $this
     */
    public function finally(Closure $body = null, $return = false): TryCatch
    {
        $this->finally = new Finally_();

        if ($body) {
            $stmts = $body();

            if ($return) {
                array_push($stmts, new Return_(array_pop($stmts)));
            }

            $this->finally->stmts = $stmts;
        }

        return $this;
    }

    /**
     * return
     *
     * @time 2021年06月02日
     * @return $this
     */
    public function return(): TryCatch
    {
        $stmt = array_pop($this->body);

        $stmt = new Return_($stmt);

        array_push($this->body, $stmt);

        return $this;
    }

    /**
     * add body
     *
     * @time 2021年06月01日
     * @param array $stmts
     * @return mixed
     */
    public function body(array $stmts)
    {
        $this->body = $stmts;

        return $this;
    }
}