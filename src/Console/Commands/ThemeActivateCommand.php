<?php

namespace NeoPhp\Console\Commands;

use NeoPhp\Console\Command;
use NeoPhp\Theme\ThemeManager;
use Exception;

class ThemeActivateCommand extends Command
{
    protected string $signature = 'theme:activate {slug : Theme slug to activate} {--type=frontend : Theme type (frontend/admin)}';
    protected string $description = 'Activate a theme';

    public function handle(): int
    {
        $slug = $this->argument('slug');
        $type = $this->option('type');

        if (!in_array($type, ['frontend', 'admin'])) {
            $this->error("Invalid type. Use 'frontend' or 'admin'.");
            return 1;
        }

        $themeManager = app('theme');

        try {
            if (!$themeManager->themeExists($slug, $type)) {
                $this->error("Theme '{$slug}' not found in {$type} themes.");
                return 1;
            }

            $this->info("Activating {$type} theme: {$slug}...");

            $themeManager->activateTheme($slug, $type);

            $this->success("Theme '{$slug}' activated successfully!");

            // Clear cache
            if (function_exists('cache_clear')) {
                cache_clear();
                $this->info('Cache cleared.');
            }

            return 0;

        } catch (Exception $e) {
            $this->error("Failed to activate theme: " . $e->getMessage());
            return 1;
        }
    }
}
