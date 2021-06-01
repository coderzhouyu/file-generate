<?php
namespace Test;

class Standard
{
    public static function output($content)
    {
        $prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

        return $prettyPrinter->prettyPrint([$content]);
    }
}