<?php

namespace Vox\Persistence\BeanProcessor;

use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\MethodGenerator;
use PhpBeans\Metadata\ClassMetadata;
use PhpBeans\Processor\AbstractStereotypeProcessor;
use Vox\Persistence\Stereotype\Repository;

class RepositoryProcessor extends AbstractStereotypeProcessor
{
    protected function fetchStereotypes()
    {
        return $this->getContainer()->getMetadataByComponent($this->getStereotypeName());
    }

    public function getStereotypeName(): string
    {
        return Repository::class;
    }

    /**
     * @param ClassMetadata $stereotype
     */
    public function process($stereotype)
    {
        if ($stereotype->getReflection()->isInterface()) {
            $methods = [];

            foreach ($stereotype->methodMetadata as $methodMetadata) {
                $methods[] = $method = MethodGenerator::copyMethodSignature($methodMetadata->reflection);
                $method->setBody("var_dump('here')");
            }

            $classGenerator = new ClassGenerator(
                $className = $stereotype->name . 'Impl',
                $stereotype->getReflection()->getNamespaceName(),
                $stereotype->getReflection()->getParentClass()->name,
                $stereotype->getReflection()->getInterfaceNames(),
                [],
                $methods,
            );

            eval($classGenerator->generate());

            $this->getContainer()->set($stereotype->name, new $className());
        }
    }
}
