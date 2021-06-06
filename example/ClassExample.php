<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .  'autoload.php';

use JaguarJack\Generate\Generator;
use JaguarJack\Generate\Build\Class_;
use JaguarJack\Generate\Build\Property;
use JaguarJack\Generate\Build\ClassMethod;
use JaguarJack\Generate\Build\Params;

Generator::namespace('App\Http\Controllers')
    ->uses([
        'App\Exceptions\FailedException',
        'App\Libary\Tools'
    ])
    ->class('Test', function (Class_ $class, Generator $generator){
        $class->extend('Good');

        $generator->property('show', function (Property $property){
            return $property->makePublic()->setDefault(true);
        });

        $generator->property('done', function ($property){
            return $property->makePublic();
        });

        $generator->method('test', function (ClassMethod $method,  Generator $generator){
            return $method->makePublic()->body([
                $generator->call('name', [
                    $generator->staticMethodCall('name'),
                    'a',Params::name('b')->makeByRef()
                ])
                    ->call('get')
                    ->call('hello')->call()
            ])->return();
        });

        $generator->const('name', 'Jack');

        $generator->traits([
            'OptionsTrait'
        ]);

    })->file('test');