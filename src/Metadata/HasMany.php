<?php

namespace NeoPhp\Metadata;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class HasMany
{
    public function __construct(
        public string $model,
        public ?string $foreignKey = null,
        public ?string $localKey = 'id'
    ) {}
}
