<?php

namespace App\Http\Controllers;

use App\Exceptions\FailedException;
use App\Libary\Tools;
use OptionsTrait;

class Test extends Good
{
    use OptionsTrait;
    const NAME = 'Jack';
    
    public $show = true;
    
    public $done;
    
    /**
     *
     * @time 2021/06/06 09:54
     * @return mixed
     */
    public function test()
    {
        return $this->name(self::name(), $a, &$b)->get()->hello();
    }
}