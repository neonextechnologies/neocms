<?php

namespace NeoPhp\Security;

use NeoPhp\Http\Request;

class CSRF
{
    protected static $tokenKey = '_csrf_token';

    public static function generateToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION[static::$tokenKey] = $token;

        return $token;
    }

    public static function getToken(): ?string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION[static::$tokenKey] ?? null;
    }

    public static function validate(string $token): bool
    {
        $sessionToken = static::getToken();

        if (!$sessionToken) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }

    public static function validateRequest(Request $request): bool
    {
        $token = $request->input('_token') ?? $request->header('X-CSRF-TOKEN');

        if (!$token) {
            return false;
        }

        return static::validate($token);
    }
}
