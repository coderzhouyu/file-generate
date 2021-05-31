<?php
namespace JaguarJack\Generate\Types;


use JaguarJack\Generate\DefineValue;
use PhpParser\Node\Expr\ArrayItem;

class Array_ extends \PhpParser\Node\Expr\Array_
{
    public function __construct(array $items = [], array $attributes = [])
    {
        parent::__construct($this->getItems($items), $attributes);
    }


    /**
     * item change
     *
     * @time 2021年05月31日
     * @param $items
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     * @return array
     */
    protected function getItems($items)
    {
        $fetchItems = [];

        $isAssoc = array_keys($items) === range(0, count($items) - 1);

        foreach ($items as $k => $value) {
            $fetchItems[] = new ArrayItem(
                DefineValue::fetch($value),

                !$isAssoc ? DefineValue::fetch($k) : null
            );
        }

        return $fetchItems;
    }
}