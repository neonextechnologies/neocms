<?php

namespace NeoPhp\Console\Commands;

use NeoPhp\Console\Command;
use NeoPhp\Theme\ThemeManager;

class ThemeListCommand extends Command
{
    protected string $signature = 'theme:list {--type= : Filter by type (frontend/admin)}';
    protected string $description = 'List all available themes';

    public function handle(): int
    {
        $themeManager = app('theme');
        $type = $this->option('type');

        $this->info('Available Themes:');
        $this->newLine();

        if ($type && !in_array($type, ['frontend', 'admin'])) {
            $this->error("Invalid type. Use 'frontend' or 'admin'.");
            return 1;
        }

        $themes = $themeManager->getAvailableThemes($type);

        if (empty($themes)) {
            $this->warn('No themes found.');
            return 0;
        }

        foreach ($themes as $themeType => $themeList) {
            $this->line("<comment>{$themeType} Themes:</comment>");
            $this->newLine();

            $currentTheme = $themeManager->getCurrentTheme($themeType);
            $currentSlug = $currentTheme['slug'] ?? null;

            foreach ($themeList as $slug => $theme) {
                $isActive = $slug === $currentSlug ? ' <info>(active)</info>' : '';
                $this->line("  • {$theme['name']} <fg=gray>[{$slug}]</>{$isActive}");
                $this->line("    Version: {$theme['version']}");
                $this->line("    Author: {$theme['author']}");
                
                if (isset($theme['description'])) {
                    $this->line("    Description: {$theme['description']}");
                }
                
                $this->newLine();
            }
        }

        return 0;
    }
}
