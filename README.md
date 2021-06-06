## File-Generate


## 目的
支持不同项目生成不同的模版文件。

## 支持

### 类
- namespace
- 类
- 类方法
- 类属性
- 类静态属性
- 异常捕获
- 方法调用
- 变量定义

### 类型
- Array
- Int
- Float|Double
- Null
- Boolen
- String

### 操作符
- 大于|大于等于
- 小于|小于等于
- 加减乘除
- 连接字符
- 等于比较|恒等比较
- 不等于比较|恒不等于比较
- 取余
- ?? 三元操作


## example
```php
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
```

## result
```php
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
```