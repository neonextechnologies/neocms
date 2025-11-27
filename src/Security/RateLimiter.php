<?php

namespace NeoPhp\Security;

class RateLimiter
{
    protected $cache;
    protected $maxAttempts;
    protected $decayMinutes;

    public function __construct($cache, int $maxAttempts = 60, int $decayMinutes = 1)
    {
        $this->cache = $cache;
        $this->maxAttempts = $maxAttempts;
        $this->decayMinutes = $decayMinutes;
    }

    public function tooManyAttempts(string $key): bool
    {
        return $this->attempts($key) >= $this->maxAttempts;
    }

    public function hit(string $key, int $decayMinutes = null): int
    {
        $decayMinutes = $decayMinutes ?? $this->decayMinutes;
        
        $this->cache->put(
            $key . ':timer',
            time() + ($decayMinutes * 60),
            $decayMinutes * 60
        );

        $attempts = (int) $this->cache->get($key, 0);
        $this->cache->put($key, $attempts + 1, $decayMinutes * 60);

        return $attempts + 1;
    }

    public function attempts(string $key): int
    {
        return (int) $this->cache->get($key, 0);
    }

    public function resetAttempts(string $key): void
    {
        $this->cache->forget($key);
        $this->cache->forget($key . ':timer');
    }

    public function availableIn(string $key): int
    {
        $timer = (int) $this->cache->get($key . ':timer', 0);
        return max(0, $timer - time());
    }
}
