<?php
namespace JaguarJack\Generate\Types;

class String_ extends \PhpParser\Node\Scalar\String_
{
    public function __construct(string $value, array $attributes = [])
    {
        parent::__construct($value, $attributes);
    }
}