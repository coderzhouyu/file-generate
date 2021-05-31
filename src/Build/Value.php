<?php
namespace JaguarJack\Generate\Build;

use JaguarJack\Generate\Exceptions\TypeNotFoundException;

class Value
{
    /**
     * fetch
     *
     * @time 2021年05月31日
     * @param $value
     * @throws TypeNotFoundException
     * @return mixed
     */
    public static function fetch($value)
    {
        $class =  '\\JaguarJack\\Generate\\Types\\' . ucfirst(gettype($value)) . '_';

        if (! class_exists($class)) {
            throw new TypeNotFoundException();
        }

        return new $class($value);
    }
}
