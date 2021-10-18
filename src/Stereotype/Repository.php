<?php

namespace Vox\Persistence\Stereotype;

/**
 * @Annotation
 * @Target({'CLASS'})
 * @NamedArgumentConstructor
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class Repository
{
    /**
     * @var string
     * @required
     */
    public $entity;

    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }
}
