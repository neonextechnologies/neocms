<?php

namespace NeoPhp\Metadata;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class MorphOne
{
    public function __construct(
        public string $model,
        public string $name
    ) {}
}
