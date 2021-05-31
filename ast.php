<?php
use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use PhpParser\BuilderFactory;
use PhpParser\PrettyPrinterAbstract;

require __DIR__ . DIRECTORY_SEPARATOR .'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$code = <<<'CODE'
<?php

namespace App\Http\Middleware;

class AuthTokenJWT
{
   
    public function handle($request, Closure $next, $guard = 'hello')
    {
    
    $a = null;
    
    $request->guard = $guard;
    
     throw new \Exception('asdasd');
        return [
        self::good()->column($name),
        
       
];
        try {
            if ($guard) {
                $request->guard = $guard;
            }

            // 判断是否有 token
            $header = $request->header();//请求头信息

            // 校区
            $school_id = getSchoolId();
            if (!in_array($school_id, ['-1', 0]) && $request->route()->getActionMethod() !== 'login') {
                SchoolInfo::getSchoolInfo($school_id);
            }

            // 无需验证 直接通过 针对未验证路径
            if (isset($request->not_verify) && $request->not_verify) {
                return $next($request);
            }

            $authorization = $header['authorization'] ?? '';
            if (!$authorization) {
                throw new FailedException('请先登录', 202);
            }

            // 判断是否 开启超时自动退出
            $config = Configuration::getVal('common_setting');//全局配置
            if ($config['is_login_overtime']) {
                $token = JWTAuth::getToken();
                $key = 'jwt:' . md5($token);
                if (!Cache::get($key)) {
                    throw new FailedException('登录超时，请重新登录', 202); // 判断是否登录超时
                }
                Cache::put($key, 1, now()->addMinutes($config['login_overtime'])); // 未超时更新失效时间
            }

            $user = $request->user($guard);
            // 需要验证的
            if (!$user) {
                throw new FailedException('登录超时，请重新登录', 202);
            }

            if ($user->status === BaseModel::DISABLE) {
                throw new FailedException('用户已被禁用, 禁止登录', 202);
            }

            (new ReloginService($user->id, $guard))->checkReloginFlag();
        } catch (FailedException $e) {
            throw new FailedException($e->getMessage(), $e->getCode());
        }
        return $next($request);
    }
}


CODE;

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
try {
    $ast = $parser->parse($code);
} catch (Error $error) {
    echo "Parse error: {$error->getMessage()}\n";
    return;
}

$dumper = new NodeDumper;

// dd($dumper->dump($ast));
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