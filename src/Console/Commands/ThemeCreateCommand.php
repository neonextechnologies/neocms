<?php

namespace NeoPhp\Console\Commands;

use NeoPhp\Console\Command;

class ThemeCreateCommand extends Command
{
    protected string $signature = 'theme:create {name : Theme name} {--type=frontend : Theme type (frontend/admin)} {--author= : Theme author}';
    protected string $description = 'Create a new theme structure';

    public function handle(): int
    {
        $name = $this->argument('name');
        $type = $this->option('type');
        $author = $this->option('author') ?: 'Neonex Technologies';

        if (!in_array($type, ['frontend', 'admin'])) {
            $this->error("Invalid type. Use 'frontend' or 'admin'.");
            return 1;
        }

        $slug = $this->slugify($name);
        $themePath = base_path("themes/{$type}/{$slug}");

        if (is_dir($themePath)) {
            $this->error("Theme '{$slug}' already exists.");
            return 1;
        }

        $this->info("Creating {$type} theme: {$name}...");

        // Create theme structure
        $this->createThemeStructure($themePath, $name, $slug, $type, $author);

        $this->success("Theme '{$name}' created successfully!");
        $this->info("Location: themes/{$type}/{$slug}");
        $this->newLine();
        $this->info("To activate the theme, run:");
        $this->line("  php neo theme:activate {$slug} --type={$type}");

        return 0;
    }

    protected function createThemeStructure(string $path, string $name, string $slug, string $type, string $author): void
    {
        // Create directories
        $directories = [
            '',
            'assets',
            'assets/css',
            'assets/js',
            'assets/images',
            'layouts',
            'components',
            'pages',
        ];

        foreach ($directories as $dir) {
            $dirPath = $path . ($dir ? '/' . $dir : '');
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
        }

        // Create theme.json
        $this->createThemeJson($path, $name, $slug, $type, $author);

        // Create main layout
        $this->createMainLayout($path, $name, $type);

        // Create example component
        $this->createExampleComponent($path);

        // Create CSS file
        $this->createStylesheet($path);

        // Create JS file
        $this->createJavascript($path);

        // Create README
        $this->createReadme($path, $name, $slug);

        // Create screenshot placeholder
        $this->createScreenshot($path);
    }

    protected function createThemeJson(string $path, string $name, string $slug, string $type, string $author): void
    {
        $themeJson = [
            'name' => $name,
            'slug' => $slug,
            'version' => '1.0.0',
            'type' => $type,
            'author' => $author,
            'license' => 'MIT',
            'description' => "A custom {$type} theme for NeoCMS",
            'screenshot' => 'screenshot.png',
            'tags' => ['custom', $type],
            'supports' => [
                'widgets' => true,
                'menus' => true,
                'custom_css' => true,
                'dark_mode' => false,
            ],
            'settings' => [
                'colors' => [
                    'primary' => '#3490dc',
                    'secondary' => '#6574cd',
                ],
                'typography' => [
                    'font_family' => 'Inter, sans-serif',
                ],
            ],
        ];

        file_put_contents(
            $path . '/theme.json',
            json_encode($themeJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    protected function createMainLayout(string $path, string $name, string $type): void
    {
        $layout = <<<'BLADE'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NeoCMS')</title>
    
    <link rel="stylesheet" href="{{ theme_asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    @include('components.header')
    
    <main class="main-content">
        @yield('content')
    </main>
    
    @include('components.footer')
    
    <script src="{{ theme_asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
BLADE;

        file_put_contents($path . '/layouts/app.blade.php', $layout);
    }

    protected function createExampleComponent(string $path): void
    {
        $header = <<<'BLADE'
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="/">NeoCMS</a>
        </div>
        <nav class="navigation">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
        </nav>
    </div>
</header>
BLADE;

        $footer = <<<'BLADE'
<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} NeoCMS. All rights reserved.</p>
    </div>
</footer>
BLADE;

        file_put_contents($path . '/components/header.blade.php', $header);
        file_put_contents($path . '/components/footer.blade.php', $footer);
    }

    protected function createStylesheet(string $path): void
    {
        $css = <<<'CSS'
/* Theme Stylesheet */

:root {
    --primary-color: #3490dc;
    --secondary-color: #6574cd;
    --text-color: #333;
    --bg-color: #fff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Inter, sans-serif;
    color: var(--text-color);
    background-color: var(--bg-color);
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.header {
    background: var(--primary-color);
    color: white;
    padding: 1rem 0;
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo a {
    color: white;
    text-decoration: none;
    font-size: 1.5rem;
    font-weight: bold;
}

.navigation a {
    color: white;
    text-decoration: none;
    margin-left: 1.5rem;
}

.main-content {
    min-height: 70vh;
    padding: 2rem 0;
}

.footer {
    background: #f8f9fa;
    padding: 2rem 0;
    text-align: center;
    margin-top: 4rem;
}
CSS;

        file_put_contents($path . '/assets/css/style.css', $css);
    }

    protected function createJavascript(string $path): void
    {
        $js = <<<'JS'
// Theme JavaScript

console.log('Theme loaded successfully!');

// Add your custom JavaScript here
JS;

        file_put_contents($path . '/assets/js/app.js', $js);
    }

    protected function createReadme(string $path, string $name, string $slug): void
    {
        $readme = <<<README
# {$name}

A custom theme for NeoCMS.

## Installation

This theme is located at `themes/{$slug}`.

## Activation

To activate this theme, run:

```bash
php neo theme:activate {$slug}
```

## Customization

- Edit layouts in `layouts/`
- Modify components in `components/`
- Customize styles in `assets/css/style.css`
- Add JavaScript in `assets/js/app.js`

## Theme Settings

Theme settings can be configured in `theme.json`.

## License

MIT
README;

        file_put_contents($path . '/README.md', $readme);
    }

    protected function createScreenshot(string $path): void
    {
        // Create a placeholder text file
        $placeholder = "Screenshot placeholder - Replace with actual theme screenshot (1200x900px recommended)";
        file_put_contents($path . '/screenshot.png.txt', $placeholder);
    }

    protected function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        return $text ?: 'theme';
    }
}
