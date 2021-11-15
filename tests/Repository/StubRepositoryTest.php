<?php

namespace Vox\PersistenceTests\Repository;

use PhpBeans\Factory\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Vox\Persistence\Stereotype\Repository;

class StubRepositoryTest extends TestCase
{
    public function testShouldGetRepository()
    {
        $builder = new ContainerBuilder();

        $builder->withAppNamespaces()
            ->withNamespaces('Vox\\PersistenceTests\\')
            ->withStereotypes(Repository::class);

        $container = $builder->build();

        $repo = $container->get(StubRepository::class);

        var_dump($repo);
    }
}