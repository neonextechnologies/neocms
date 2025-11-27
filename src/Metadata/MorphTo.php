<?php

namespace NeoPhp\Metadata;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class MorphTo
{
    public function __construct(
        public ?string $name = null
    ) {}
}
