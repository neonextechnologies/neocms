<?php

if (!function_exists('theme_asset')) {
    /**
     * Get theme asset URL
     *
     * @param string $path Asset path
     * @param string $type Theme type (frontend/admin)
     * @return string
     */
    function theme_asset(string $path, string $type = 'frontend'): string
    {
        $themeManager = app('theme');
        return $themeManager->asset($path, $type);
    }
}

if (!function_exists('current_theme')) {
    /**
     * Get current active theme
     *
     * @param string $type Theme type (frontend/admin)
     * @return array|null
     */
    function current_theme(string $type = 'frontend'): ?array
    {
        $themeManager = app('theme');
        return $themeManager->getCurrentTheme($type);
    }
}

if (!function_exists('theme_path')) {
    /**
     * Get theme path
     *
     * @param string $type Theme type (frontend/admin)
     * @return string|null
     */
    function theme_path(string $type = 'frontend'): ?string
    {
        $themeManager = app('theme');
        return $themeManager->getThemeViewPath($type);
    }
}

if (!function_exists('theme_url')) {
    /**
     * Get theme public URL
     *
     * @param string $type Theme type (frontend/admin)
     * @return string|null
     */
    function theme_url(string $type = 'frontend'): ?string
    {
        $themeManager = app('theme');
        return $themeManager->getThemeUrl($type);
    }
}
