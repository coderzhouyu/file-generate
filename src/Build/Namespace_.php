<?php
namespace JaguarJack\Generate\Build;


use Phalcon\Mvc\Model\Transaction\Failed;
use PhpParser\Builder\Use_;
use PhpParser\BuilderFactory;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\UseUse;

class Namespace_ extends \PhpParser\Builder\Namespace_
{
    public static function name($namespace)
    {
        return new self($namespace);
    }

    public function fetch()
    {
        return $this->getNode();
    }


    public function useUse(...$uses)
    {
        foreach ($uses as $use) {
            if (str_contains($use, ' as ')) {
                $uses = explode(' as ', $use);

                $use = new Use_(
                    new Name($uses[0]), \PhpParser\Node\Stmt\Use_::TYPE_NORMAL
                );

                $use->as($uses[1]);
            } else {
                $use = new Use_(
                    new Name($use), \PhpParser\Node\Stmt\Use_::TYPE_NORMAL
                );
            }

            $this->addStmt(
                $use->getNode()
            );
        }

        return $this;
    }

    /**
     * 使用 class
     *
     * @time 2021年06月01日
     * @param Class_ $class
     * @return Namespace_
     * @throws \Exception
     */
    public function useClass(Class_ $class)
    {
        if (! $class instanceof Class_) {
            throw new \Exception('Class must be instanceof ' . Class_::class);
        }

        return $this->addStmt($class->fetch());
    }
}