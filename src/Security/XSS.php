<?php

namespace NeoPhp\Security;

class XSS
{
    public static function clean($data)
    {
        if (is_array($data)) {
            return array_map([static::class, 'clean'], $data);
        }

        if (!is_string($data)) {
            return $data;
        }

        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function cleanDeep(array $data): array
    {
        return array_map([static::class, 'clean'], $data);
    }
}
