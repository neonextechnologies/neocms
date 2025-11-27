<?php

namespace NeoPhp\Console\Commands;

use NeoPhp\Console\Command;
use ZipArchive;
use Exception;

class ThemeInstallCommand extends Command
{
    protected string $signature = 'theme:install {path : Path to theme zip file or directory} {--type=frontend : Theme type (frontend/admin)}';
    protected string $description = 'Install a theme from zip file or directory';

    public function handle(): int
    {
        $path = $this->argument('path');
        $type = $this->option('type');

        if (!in_array($type, ['frontend', 'admin'])) {
            $this->error("Invalid type. Use 'frontend' or 'admin'.");
            return 1;
        }

        try {
            $this->info("Installing {$type} theme from: {$path}");

            $themesPath = base_path("themes/{$type}");

            // Ensure themes directory exists
            if (!is_dir($themesPath)) {
                mkdir($themesPath, 0755, true);
            }

            // Check if path is a zip file
            if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === 'zip') {
                return $this->installFromZip($path, $themesPath, $type);
            }

            // Check if path is a directory
            if (is_dir($path)) {
                return $this->installFromDirectory($path, $themesPath, $type);
            }

            $this->error("Invalid path. Provide a zip file or directory.");
            return 1;

        } catch (Exception $e) {
            $this->error("Failed to install theme: " . $e->getMessage());
            return 1;
        }
    }

    protected function installFromZip(string $zipPath, string $themesPath, string $type): int
    {
        if (!class_exists('ZipArchive')) {
            $this->error("ZipArchive extension is not installed.");
            return 1;
        }

        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {
            $this->error("Failed to open zip file.");
            return 1;
        }

        // Extract to temporary directory first
        $tempDir = sys_get_temp_dir() . '/neocms_theme_' . uniqid();
        $zip->extractTo($tempDir);
        $zip->close();

        // Find theme.json to get theme slug
        $themeJsonPath = $this->findThemeJson($tempDir);

        if (!$themeJsonPath) {
            $this->error("theme.json not found in zip file.");
            $this->deleteDirectory($tempDir);
            return 1;
        }

        $themeData = json_decode(file_get_contents($themeJsonPath), true);

        if (!isset($themeData['slug'])) {
            $this->error("Invalid theme.json: missing 'slug' field.");
            $this->deleteDirectory($tempDir);
            return 1;
        }

        $themeDir = dirname($themeJsonPath);
        $targetDir = $themesPath . '/' . $themeData['slug'];

        // Move to themes directory
        if (is_dir($targetDir)) {
            $this->warn("Theme '{$themeData['slug']}' already exists. Overwriting...");
            $this->deleteDirectory($targetDir);
        }

        rename($themeDir, $targetDir);
        $this->deleteDirectory($tempDir);

        $this->success("Theme '{$themeData['slug']}' installed successfully!");

        return 0;
    }

    protected function installFromDirectory(string $sourcePath, string $themesPath, string $type): int
    {
        $themeJsonPath = $sourcePath . '/theme.json';

        if (!file_exists($themeJsonPath)) {
            $this->error("theme.json not found in directory.");
            return 1;
        }

        $themeData = json_decode(file_get_contents($themeJsonPath), true);

        if (!isset($themeData['slug'])) {
            $this->error("Invalid theme.json: missing 'slug' field.");
            return 1;
        }

        $targetDir = $themesPath . '/' . $themeData['slug'];

        if (is_dir($targetDir)) {
            $this->warn("Theme '{$themeData['slug']}' already exists. Overwriting...");
            $this->deleteDirectory($targetDir);
        }

        // Copy directory
        $this->copyDirectory($sourcePath, $targetDir);

        $this->success("Theme '{$themeData['slug']}' installed successfully!");

        return 0;
    }

    protected function findThemeJson(string $directory): ?string
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getFilename() === 'theme.json') {
                return $file->getPathname();
            }
        }

        return null;
    }

    protected function copyDirectory(string $source, string $destination): void
    {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

            if ($item->isDir()) {
                if (!is_dir($target)) {
                    mkdir($target, 0755, true);
                }
            } else {
                copy($item, $target);
            }
        }
    }

    protected function deleteDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($items as $item) {
            if ($item->isDir()) {
                rmdir($item->getRealPath());
            } else {
                unlink($item->getRealPath());
            }
        }

        rmdir($directory);
    }
}
