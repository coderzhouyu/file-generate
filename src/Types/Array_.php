<?php
namespace JaguarJack\Generate\Types;


use JaguarJack\Generate\Build\Value;
use PhpParser\Comment\Doc;
use PhpParser\Node\Expr\ArrayItem;

class Array_ extends \PhpParser\Node\Expr\Array_
{
    protected $pretty;

    /**
     * Array_ constructor.
     * @param array $items
     * @param false $pretty
     */
    public function __construct(array $items = [], $pretty = true)
    {
        $this->pretty = $pretty;

        parent::__construct($this->getItems($items), [
            'kind' => self::KIND_SHORT
        ]);
    }


    /**
     * item change
     *
     * @time 2021年05月31日
     * @param $items
     * @return array
     */
    protected function getItems($items): array
    {
        $fetchItems = [];

        $isAssoc = array_keys($items) === range(0, count($items) - 1);

        foreach ($items as $k => $value) {
            $item = new ArrayItem(
                Value::fetch($value),

                !$isAssoc ? Value::fetch($k) : null
            );

            if ($this->pretty && $k > 0) {
                $item->setDocComment(new Doc(PHP_EOL));
            }

            $fetchItems[] = $item;
        }

        return $fetchItems;
    }
}