<?php
namespace JaguarJack\Generate\Build;

class Value
{
    /**
     * fetch
     *
     * @time 2021年05月31日
     * @param $value
     * @return mixed
     */
    public static function fetch($value)
    {
        $class =  '\\JaguarJack\\Generate\\Types\\' . ucfirst(gettype($value)) . '_';

        if (! class_exists($class)) {
            return $value;
        }

        return new $class($value);
    }
}
