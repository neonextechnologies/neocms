<?php

namespace NeoPhp\Theme;

use NeoPhp\Config\Config;
use Exception;

class ThemeManager
{
    protected array $themes = [];
    protected ?string $activeTheme = null;
    protected ?string $activeAdminTheme = null;
    protected string $themesPath;
    
    public function __construct(protected Config $config)
    {
        $this->themesPath = base_path('themes');
        $this->loadThemes();
        $this->setActiveThemes();
    }
    
    /**
     * Load all available themes
     */
    protected function loadThemes(): void
    {
        $frontendPath = $this->themesPath . '/frontend';
        $adminPath = $this->themesPath . '/admin';
        
        if (is_dir($frontendPath)) {
            $this->scanThemes($frontendPath, 'frontend');
        }
        
        if (is_dir($adminPath)) {
            $this->scanThemes($adminPath, 'admin');
        }
    }
    
    /**
     * Scan directory for themes
     */
    protected function scanThemes(string $path, string $type): void
    {
        $directories = glob($path . '/*', GLOB_ONLYDIR);
        
        foreach ($directories as $dir) {
            $themeJsonPath = $dir . '/theme.json';
            
            if (file_exists($themeJsonPath)) {
                $themeData = json_decode(file_get_contents($themeJsonPath), true);
                
                if ($themeData && isset($themeData['slug'])) {
                    $themeData['path'] = $dir;
                    $themeData['type'] = $type;
                    $this->themes[$type][$themeData['slug']] = $themeData;
                }
            }
        }
    }
    
    /**
     * Set active themes from config
     */
    protected function setActiveThemes(): void
    {
        $this->activeTheme = $this->config->get('theme.active_frontend', 'default');
        $this->activeAdminTheme = $this->config->get('theme.active_admin', 'neo-admin');
    }
    
    /**
     * Get all available themes
     */
    public function getAvailableThemes(string $type = null): array
    {
        if ($type) {
            return $this->themes[$type] ?? [];
        }
        
        return $this->themes;
    }
    
    /**
     * Get current active theme
     */
    public function getCurrentTheme(string $type = 'frontend'): ?array
    {
        $slug = $type === 'admin' ? $this->activeAdminTheme : $this->activeTheme;
        
        return $this->themes[$type][$slug] ?? null;
    }
    
    /**
     * Get theme by slug
     */
    public function getTheme(string $slug, string $type = 'frontend'): ?array
    {
        return $this->themes[$type][$slug] ?? null;
    }
    
    /**
     * Activate a theme
     */
    public function activateTheme(string $slug, string $type = 'frontend'): bool
    {
        if (!isset($this->themes[$type][$slug])) {
            throw new Exception("Theme '{$slug}' not found in {$type} themes.");
        }
        
        // Validate theme structure
        if (!$this->validateTheme($this->themes[$type][$slug])) {
            throw new Exception("Theme '{$slug}' is invalid or corrupted.");
        }
        
        // Update config file
        $configPath = config_path('theme.php');
        $configKey = $type === 'admin' ? 'active_admin' : 'active_frontend';
        
        // Update in-memory config
        if ($type === 'admin') {
            $this->activeAdminTheme = $slug;
        } else {
            $this->activeTheme = $slug;
        }
        
        // Persist to config file
        $this->updateThemeConfig($configKey, $slug);
        
        return true;
    }
    
    /**
     * Register a new theme
     */
    public function registerTheme(string $path, string $type = 'frontend'): bool
    {
        $themeJsonPath = $path . '/theme.json';
        
        if (!file_exists($themeJsonPath)) {
            throw new Exception("theme.json not found in the provided path.");
        }
        
        $themeData = json_decode(file_get_contents($themeJsonPath), true);
        
        if (!$themeData || !isset($themeData['slug'])) {
            throw new Exception("Invalid theme.json format.");
        }
        
        $themeData['path'] = $path;
        $themeData['type'] = $type;
        
        $this->themes[$type][$themeData['slug']] = $themeData;
        
        return true;
    }
    
    /**
     * Validate theme structure
     */
    public function validateTheme(array $theme): bool
    {
        $requiredFiles = [
            '/theme.json',
            '/layouts/app.blade.php'
        ];
        
        foreach ($requiredFiles as $file) {
            if (!file_exists($theme['path'] . $file)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Get theme view path
     */
    public function getThemeViewPath(string $type = 'frontend'): ?string
    {
        $theme = $this->getCurrentTheme($type);
        
        if (!$theme) {
            return null;
        }
        
        return $theme['path'];
    }
    
    /**
     * Get theme asset path
     */
    public function getThemeAssetPath(string $type = 'frontend'): ?string
    {
        $theme = $this->getCurrentTheme($type);
        
        if (!$theme) {
            return null;
        }
        
        return $theme['path'] . '/assets';
    }
    
    /**
     * Get theme public URL
     */
    public function getThemeUrl(string $type = 'frontend'): ?string
    {
        $theme = $this->getCurrentTheme($type);
        
        if (!$theme) {
            return null;
        }
        
        // Convert absolute path to public URL
        $relativePath = str_replace(base_path(), '', $theme['path']);
        $relativePath = str_replace('\\', '/', $relativePath);
        
        return url($relativePath);
    }
    
    /**
     * Get theme asset URL
     */
    public function asset(string $path, string $type = 'frontend'): string
    {
        $themeUrl = $this->getThemeUrl($type);
        
        if (!$themeUrl) {
            return url('assets/' . $path);
        }
        
        return $themeUrl . '/assets/' . ltrim($path, '/');
    }
    
    /**
     * Update theme configuration file
     */
    protected function updateThemeConfig(string $key, string $value): void
    {
        $configPath = config_path('theme.php');
        
        if (file_exists($configPath)) {
            $content = file_get_contents($configPath);
            
            // Match pattern for both direct values and env() calls
            // e.g., 'active_admin' => 'value' or 'active_admin' => env('KEY', 'default')
            $pattern = "/('{$key}'\s*=>\s*)(?:'[^']*'|env\([^)]+\))/";
            $replacement = "$1'{$value}'";
            $content = preg_replace($pattern, $replacement, $content);
            
            file_put_contents($configPath, $content);
        }
    }
    
    /**
     * Check if theme exists
     */
    public function themeExists(string $slug, string $type = 'frontend'): bool
    {
        return isset($this->themes[$type][$slug]);
    }
    
    /**
     * Get theme metadata
     */
    public function getThemeMetadata(string $slug, string $type = 'frontend'): ?array
    {
        return $this->getTheme($slug, $type);
    }
}
