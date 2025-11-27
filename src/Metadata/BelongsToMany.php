<?php

namespace NeoPhp\Metadata;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class BelongsToMany
{
    public function __construct(
        public string $model,
        public ?string $pivotTable = null,
        public ?string $foreignKey = null,
        public ?string $relatedKey = null
    ) {}
}
