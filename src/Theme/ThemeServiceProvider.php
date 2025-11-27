<?php

namespace NeoPhp\Theme;

use NeoPhp\Core\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register theme services
     */
    public function register(): void
    {
        // Register ThemeManager as singleton
        $this->app->singleton('theme', function ($app) {
            return new ThemeManager($app->make('config'));
        });
        
        // Register theme helper
        $this->app->alias('theme', ThemeManager::class);
    }
    
    /**
     * Boot theme services
     */
    public function boot(): void
    {
        $theme = $this->app->make('theme');
        
        // Register frontend theme views
        $this->registerThemeViews($theme, 'frontend');
        
        // Register admin theme views
        $this->registerThemeViews($theme, 'admin');
        
        // Publish theme assets
        $this->publishThemeAssets($theme);
        
        // Share theme data with all views
        $this->shareThemeDataWithViews($theme);
    }
    
    /**
     * Register theme view paths
     */
    protected function registerThemeViews(ThemeManager $theme, string $type): void
    {
        $viewPath = $theme->getThemeViewPath($type);
        
        if ($viewPath && is_dir($viewPath)) {
            // Add theme views path
            $viewEngine = $this->app->make('view');
            
            if (method_exists($viewEngine, 'addNamespace')) {
                $viewEngine->addNamespace("theme.{$type}", $viewPath);
            }
            
            // Add to view paths
            if (method_exists($viewEngine, 'addPath')) {
                $viewEngine->addPath($viewPath);
            }
        }
    }
    
    /**
     * Publish theme assets to public directory
     */
    protected function publishThemeAssets(ThemeManager $theme): void
    {
        // This would symlink or copy theme assets to public directory
        // For now, we'll handle assets directly from theme directory
        
        $frontendTheme = $theme->getCurrentTheme('frontend');
        $adminTheme = $theme->getCurrentTheme('admin');
        
        if ($frontendTheme) {
            $this->ensureAssetLink($frontendTheme, 'frontend');
        }
        
        if ($adminTheme) {
            $this->ensureAssetLink($adminTheme, 'admin');
        }
    }
    
    /**
     * Ensure asset symbolic link exists
     */
    protected function ensureAssetLink(array $theme, string $type): void
    {
        $publicPath = public_path("themes/{$type}/{$theme['slug']}");
        $themePath = $theme['path'];
        
        // Create public themes directory if not exists
        if (!is_dir(dirname($publicPath))) {
            mkdir(dirname($publicPath), 0755, true);
        }
        
        // Create symbolic link if not exists
        if (!file_exists($publicPath) && is_dir($themePath)) {
            // On Windows, we might need to copy instead of symlink
            if (PHP_OS_FAMILY === 'Windows') {
                // Skip for now, handle in deployment
            } else {
                @symlink($themePath, $publicPath);
            }
        }
    }
    
    /**
     * Share theme data with all views
     */
    protected function shareThemeDataWithViews(ThemeManager $theme): void
    {
        $viewEngine = $this->app->make('view');
        
        if (method_exists($viewEngine, 'share')) {
            $viewEngine->share('currentTheme', $theme->getCurrentTheme('frontend'));
            $viewEngine->share('currentAdminTheme', $theme->getCurrentTheme('admin'));
            $viewEngine->share('themeManager', $theme);
        }
    }
}
