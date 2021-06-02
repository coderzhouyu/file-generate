<?php
namespace JaguarJack\Generate\Build;

use PhpParser\Builder\TraitUseAdaptation;
use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node\Const_;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\TraitUse;

class Class_ extends \PhpParser\Builder\Class_
{
    /**
     * name
     *
     * @time 2021年06月01日
     * @param string $name
     * @return Class_
     */
    public static function name(string $name): Class_
    {
        return new self($name);
    }

    /**
     * fetch
     *
     * @time 2021年06月01日
     * @return \PhpParser\Node|\PhpParser\Node\Stmt\Class_
     */
    public function fetch()
    {
        return $this->getNode();
    }

    /**
     * use trait
     *
     * @time 2021年06月01日
     * @param mixed ...$traits
     * @return Class_
     */
    public function useTrait(...$traits): Class_
    {
        $smtTraits = $adaptations = [];

        foreach ($traits as $trait) {
            if (str_contains($trait, '::')) {
                $trait = explode('::', $trait);

                $smtTraits[] = new Name($trait[0]);

                if (str_contains($trait[1], 'as')) {
                    $as = explode('as', $trait[1]);

                    $adaptations[] = (new TraitUseAdaptation($trait[0], $as[0]))->as($as[1])->getNode();
                }

                if (str_contains($trait[1], 'insteadof')) {
                    $instanceof = explode('insteadof', $trait[1]);

                    $adaptations[] = (new TraitUseAdaptation($trait[0], $instanceof[0]))->insteadof($instanceof[1])->getNode();
                }

            } else {
                $smtTraits[] = new Name($trait);
            }

        }

        return $this->addStmt(new TraitUse($smtTraits, $adaptations));
    }


    /**
     * 类常量
     *
     * @time 2021年06月01日
     * @param $const
     * @param null $value
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     * @return Class_
     */
    public function useConst($const, $value = null, $document = null): Class_
    {
        if (is_array($const)) {
            foreach ($const as $k => $v) {
                $classConst = new ClassConst(
                    [new Const_(strtoupper($k), Value::fetch($v))]
                );

                if ($document) {
                    $classConst->setDocComment(new Doc($document));
                }

                $this->addStmt($classConst);
            }

            return $this;
        } else {
            $const = new Const_(strtoupper($const), Value::fetch($value));

            $classConst = new ClassConst([$const]);

            if ($document) {
                $classConst->setDocComment(new Doc($document));
            }

            return $this->addStmt($classConst);
        }
    }


    /**
     * 属性
     *
     * @time 2021年06月01日
     * @param $name
     * @param null $value
     * @param string $visible
     * @param false $isStatic
     * @param null $document
     * @throws \JaguarJack\Generate\Exceptions\TypeNotFoundException
     * @return Class_
     */
    public function useProperty($name, $value = null, $visible = 'public', $isStatic = false, $document = null): Class_
    {
        if ($name instanceof Property) {
            return $this->addStmt($name->fetch());
        }

        $property = (new BuilderFactory)->property($name)->setDefault(Value::fetch($value));

        if ($isStatic) {
            $property->makeStatic();
        }

        if ($document) {
            $property->setDocComment(new Doc($document));
        }

        $property->{'make' . ucwords($visible)}();

        return $this->addStmt($property->getNode());
    }

    /**
     * 添加类方法
     *
     * @time 2021年06月01日
     * @param ClassMethod $method
     * @return Class_
     */
    public function useMethod(ClassMethod $method): Class_
    {
        return $this->addStmt($method->fetch());
    }
}