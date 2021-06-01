<?php

if (! function_exists('str_contains')) {

    function str_contains(string $haystack, $needle): bool
    {
        return strpos($haystack, $needle) === false;
    }
}