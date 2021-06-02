<?php
use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use PhpParser\BuilderFactory;
use PhpParser\PrettyPrinterAbstract;

require __DIR__ . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';


$t = \JaguarJack\Generate\Build\Namespace_::name('catchAdmin\cms\controller')

    ->useUse(
        'catcher\base\CatchRequest as Request',
        'catcher\CatchResponse',
        'catcher\base\CatchController',
        'catchAdmin\cms\model\Articles as articlesModel'
    )
    ->useClass(
        \JaguarJack\Generate\Build\Class_::name('Test')
            ->extend('CatchController')
            ->useProperty(\JaguarJack\Generate\Build\Property::name('articlesModel')->makeProtected())
            ->useMethod(
                \JaguarJack\Generate\Build\ClassMethod::name('index')->makePublic()
                    ->addParam(
                        \JaguarJack\Generate\Build\Params::name('request')->setType('Request')
                    )
                    ->body([
                       \JaguarJack\Generate\Build\MethodCall::staticCall('CatchResponse',
                           'paginate',
                           [
                               new \JaguarJack\Generate\Build\MethodCall('this->articlesModel', 'getList')
                           ]
                       )
                    ])
                    ->return()
            )
            ->useMethod(
                \JaguarJack\Generate\Build\ClassMethod::name('save')->makePublic()
                    ->addParam(
                        \JaguarJack\Generate\Build\Params::name('request')->setType('Request')
                    )
                    ->body([
                        \JaguarJack\Generate\Build\MethodCall::staticCall('CatchResponse',
                            'success',
                            [
                                new \JaguarJack\Generate\Build\MethodCall(
                                    'this->articlesModel',
                                    'storeBy',
                                    [
                                        new \JaguarJack\Generate\Build\MethodCall('request', 'post')
                                    ]
                                )
                            ]
                        )
                    ])
                    ->return()
            )

            ->useMethod(
                \JaguarJack\Generate\Build\ClassMethod::name('read')->makePublic()
                    ->addParam(
                        \JaguarJack\Generate\Build\Params::name('id')
                    )
                    ->body([
                        \JaguarJack\Generate\Build\MethodCall::staticCall('CatchResponse',
                            'success',
                            [
                                new \JaguarJack\Generate\Build\MethodCall(
                                    'this->articlesModel',
                                    'findBy',
                                    [
                                        'id'
                                    ]
                                )
                            ]
                        )
                    ])
                    ->return()
            )
            ->useMethod(
                \JaguarJack\Generate\Build\ClassMethod::name('update')->makePublic()
                    ->addParam([
                        \JaguarJack\Generate\Build\Params::name('request')->setType('Request'),
                        \JaguarJack\Generate\Build\Params::name('id')
                    ])
                    ->body([
                        \JaguarJack\Generate\Build\MethodCall::staticCall('CatchResponse',
                            'success',
                            [
                                new \JaguarJack\Generate\Build\MethodCall('this->articlesModel', 'updateBy', [
                                    'id',
                                    new \JaguarJack\Generate\Build\MethodCall('request', 'post')
                                ])
                            ]
                        )
                    ])
                    ->return()
            )
            ->useMethod(
                \JaguarJack\Generate\Build\ClassMethod::name('delete')->makePublic()
                    ->addParam([
                        \JaguarJack\Generate\Build\Params::name('id')
                    ])
                    ->body([
                        \JaguarJack\Generate\Build\MethodCall::staticCall('CatchResponse',
                            'success',
                            [
                                new \JaguarJack\Generate\Build\MethodCall('this->articlesModel', 'deleteBy', [
                                    'id',
                                ])
                            ]
                        )
                    ])
                    ->return()
            )
    )
    ->fetch();

dd(\Test\Standard::output($t));


$code = <<<'CODE'
<?php

$a = implode(',', [123, 123]);


CODE;

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
try {
    $ast = $parser->parse($code);
} catch (Error $error) {
    echo "Parse error: {$error->getMessage()}\n";
    return;
}

$dumper = new NodeDumper;

dd($dumper->dump($ast));
$factory = new BuilderFactory();

// $s = \JaguarJack\Generate\DefineVariable::fetch('a', null, '// goods');


$s = new \JaguarJack\Generate\Build\Method('ni');


    // $factory->var('asd');
//$s = new \JaguarJack\Generate\DefineVariable('a', '123');

$prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

dd($prettyPrinter->prettyPrintFile([$s]));

$namespace = $factory->namespace('App\\Http');

$namespace->addStmt(
    $factory->class('Apple')
            ->extend('Fruit')
            ->addStmt($factory->property('yes')
                            ->makeProtected()
                            ->setDefault(1)
                            ->setType('array')
                            ->setDocComment(
                                (new \PhpParser\Comment\Doc(
                                    '// yes 的人'
                                ))
                            )
            )
            ->addStmt($factory->method('first')->makePublic()->addParam(
                (new \PhpParser\Node\Param(
                    (new \PhpParser\Node\Expr\Variable('name', [])),
                    new \PhpParser\Node\Scalar\String_('hello')
                ))
                )->addStmt(
                    (new \PhpParser\Node\Stmt\TryCatch([
                        new \PhpParser\Node\Stmt\If_(
                            (new \PhpParser\Node\Expr\Variable('guard'))
                        ),

                        (new \PhpParser\Node\Stmt\Return_(
                            (new \PhpParser\Node\Expr\Array_([
                               new \PhpParser\Node\Expr\MethodCall(
                                   new \PhpParser\Node\Expr\StaticCall(
                                       new \PhpParser\Node\Name('self'),
                                       new \PhpParser\Node\Name('good')
                                   ),

                                    new \PhpParser\Node\Name('column'),

                                    [
                                        new \PhpParser\Node\Arg(
                                            new \PhpParser\Node\Expr\Variable('name')
                                        )
                                    ]
                               ),

                                new \PhpParser\Node\Expr\MethodCall(
                                    new \PhpParser\Node\Expr\StaticCall(
                                        new \PhpParser\Node\Name('self'),
                                        new \PhpParser\Node\Name('good')
                                    ),

                                    new \PhpParser\Node\Name('column'),

                                    [
                                        new \PhpParser\Node\Arg(
                                            new \PhpParser\Node\Expr\Variable('name')
                                        )
                                    ]
                                ),

                                new \PhpParser\Node\Expr\MethodCall(
                                    new \PhpParser\Node\Expr\StaticCall(
                                        new \PhpParser\Node\Name('self'),
                                        new \PhpParser\Node\Name('good')
                                    ),

                                    new \PhpParser\Node\Name('column'),

                                    [
                                        new \PhpParser\Node\Arg(
                                            new \PhpParser\Node\Expr\Variable('name')
                                        )
                                    ]
                                ),
                            ]))
                        )),
                    ], [
                        new \PhpParser\Node\Stmt\Catch_([
                            (new \PhpParser\Node\Expr\Variable('exception', [

                            ])),
                            (new \PhpParser\Node\Expr\Variable('exception', [

                            ])),
                            (new \PhpParser\Node\Expr\Variable('exception', [

                            ]))
                        ]),
                        new \PhpParser\Node\Stmt\Finally_([
                            new \PhpParser\Node\Stmt\Throw_(
                                new \PhpParser\Node\Expr\New_(
                                    new \PhpParser\Node\Name\FullyQualified('Exception'),
                                    [
                                        new \PhpParser\Node\Arg(
                                            new \PhpParser\Node\Scalar\String_('asdasd')
                                        )
                                    ]
                                )
                            )
                        ])
                    ]))
                )
            )

);


$stmts = array($namespace->getNode());

$prettyPrinter = new \PhpParser\PrettyPrinter\Standard();

dd($prettyPrinter->prettyPrintFile($stmts));