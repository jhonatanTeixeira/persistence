<?php

namespace Vox\PersistenceTests\Repository;

use Vox\Persistence\Stereotype\Repository;

#[Repository('some-repository')]
interface StubRepository
{
    function findById($id);

    function findBy(array $criteria);
}