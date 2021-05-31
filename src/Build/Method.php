<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Node\Param;

class Method extends \PhpParser\Builder\Method
{
    protected $params;

    /**
     * Method constructor.
     * @param string $name
     * @param array $params
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     */
    public function __construct(string $name, array $params = [])
    {
        parent::__construct($name);

        $this->setMethodParams($params);
    }


    /**
     * 设置方法参数
     *
     * @time 2021年05月31日
     * @param $params
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     * @return void
     */
    protected function setMethodParams($params)
    {
        foreach ($params as $k => $value) {
            if (is_numeric($k)) {
                $this->addParam(
                    new Param(
                        new \PhpParser\Node\Expr\Variable($value)
                    )
                );
            } else {
                $this->addParam(
                    new Param(
                        new \PhpParser\Node\Expr\Variable($k),
                        Value::fetch($value)
                    )
                );
            }

        }
    }

}