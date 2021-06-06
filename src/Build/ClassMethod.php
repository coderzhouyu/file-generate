<?php

namespace JaguarJack\Generate\Build;

use PhpParser\Comment\Doc;
use PhpParser\Node\Stmt\Return_;

class ClassMethod extends Method
{

    /**
     * @var array
     */
    protected $methodBody;


    /**
     * @var bool
     */
    protected $return = false;

    protected $document;


    /**
     * @var string
     */
    protected $paramDoc = '';


    /**
     * 设置方法名称
     *
     * @time 2021年06月01日
     * @param string $name
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     * @return ClassMethod
     */
    public static function name(string $name)
    {
        return new self($name);
    }


    /**
     *
     * @time 2021年06月01日
     * @return \PhpParser\Node|\PhpParser\Node\Stmt\ClassMethod
     */
    public function fetch()
    {
        if ($this->return) {
            $stmt = array_pop($this->methodBody);

            $stmt = new Return_($stmt);

            array_push($this->methodBody, $stmt);
        }

        if ($this->methodBody) {
            $this->addStmts($this->methodBody);
        }

        $this->setDocComment( new Doc($this->document ? : $this->setDefaultDocument()));

        return $this->getNode();
    }


    /**
     *
     *
     * @time 2021年06月01日
     * @param \PhpParser\Builder\Param|\PhpParser\Node\Param|Params|array|string $param
     * @return ClassMethod
     */
    public function addParam($param): ClassMethod
    {
        if (is_array($param)) {
            foreach ($param as $p) {
                parent::addParam(is_string($p) ? Params::name($p) : $p->fetch());

                $this->parseParamDoc($p);
            }
        } else {
            parent::addParam(is_string($param) ? Params::name($param) : $param->fetch());

            $this->parseParamDoc($param);
        }

        return $this;
    }


    /**
     * 方法返回
     *
     * @time 2021年06月02日
     * @return $this
     */
    public function return(): ClassMethod
    {
        $this->return = true;

        return $this;
    }

    /**
     * 添加方法体
     *
     * @time 2021年06月01日
     * @param array $stmts
     * @return ClassMethod
     */
    public function body(array $stmts): ClassMethod
    {
       $this->methodBody = $stmts;

       return $this;
    }

    /**
     * 注释
     *
     * @time 2021年06月02日
     * @param $document
     * @return ClassMethod
     */
    public function document($document): ClassMethod
    {
        $this->document = $document;

        return $this;
    }

    /**
     * default comment
     *
     * @time 2021年06月06日
     * @return array|string|string[]
     */
    protected function setDefaultDocument()
    {
        $now = date('Y/m/d H:i');

        $return = $this->returnType ? : 'mixed';

        $doc = <<<DOC
/**
 *
 * @time {$now}
{PARAMS}
 * @return {$return}
 */
DOC;

        return PHP_EOL . str_replace('{PARAMS}', $this->paramDoc, $doc);
    }

    /**
     *
     * @time 2021年06月06日
     * @param $param
     * @return void
     */
    protected function parseParamDoc($param)
    {
        $temp = ' * @param %s$%s' . PHP_EOL;

        if ($param instanceof Params) {
            $this->paramDoc .= $param->getType() ?
                    sprintf($temp, $param->getType() . ' ', $param->getName()) :

                    sprintf($temp, '', $param->getName());
        } else {
            $this->paramDoc .= sprintf($temp, '',$param);
        }
    }

}