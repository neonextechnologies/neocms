<?php

namespace NeoPhp\Console;

/**
 * Base Command Class
 * All CLI commands extend this class
 */
abstract class Command
{
    protected string $signature = '';
    protected string $description = '';
    protected Input $input;
    protected Output $output;
    protected array $arguments = [];
    protected array $options = [];

    public function __construct(Input $input, Output $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->parseSignature();
    }

    /**
     * Parse signature and map arguments
     */
    protected function parseSignature(): void
    {
        if (empty($this->signature)) {
            return;
        }

        // Parse signature format: command {arg1} {arg2?} {--option=default}
        preg_match_all('/{([^}]+)}/', $this->signature, $matches);
        
        $argIndex = 0;
        foreach ($matches[1] as $param) {
            if (str_starts_with($param, '--')) {
                // Option
                continue;
            }
            
            // Argument
            $argName = trim($param, '? ');
            $argName = explode(':', $argName)[0]; // Remove description
            $argName = explode('=', $argName)[0]; // Remove default
            $argName = trim($argName);
            
            $this->arguments[$argName] = $argIndex++;
        }
    }

    /**
     * Execute the command
     */
    abstract public function handle(): int;

    /**
     * Get command signature
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * Get command description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get argument value
     */
    protected function argument(string $name): mixed
    {
        // If name is mapped, use the index
        if (isset($this->arguments[$name])) {
            return $this->input->getArgument($this->arguments[$name]);
        }
        
        // Fallback to direct string lookup (won't work with current Input)
        return $this->input->getArgument($name);
    }

    /**
     * Get option value
     */
    protected function option(string $name): mixed
    {
        return $this->input->getOption($name);
    }

    /**
     * Ask a question
     */
    protected function ask(string $question, ?string $default = null): string
    {
        return $this->output->ask($question, $default);
    }

    /**
     * Ask for confirmation
     */
    protected function confirm(string $question, bool $default = false): bool
    {
        return $this->output->confirm($question, $default);
    }

    /**
     * Ask with secret input
     */
    protected function secret(string $question): string
    {
        return $this->output->secret($question);
    }

    /**
     * Ask with choices
     */
    protected function choice(string $question, array $choices, $default = null): string
    {
        return $this->output->choice($question, $choices, $default);
    }

    /**
     * Write info message
     */
    protected function info(string $message): void
    {
        $this->output->info($message);
    }

    /**
     * Write success message
     */
    protected function success(string $message): void
    {
        $this->output->success($message);
    }

    /**
     * Write error message
     */
    protected function error(string $message): void
    {
        $this->output->error($message);
    }

    /**
     * Write warning message
     */
    protected function warning(string $message): void
    {
        $this->output->warning($message);
    }

    /**
     * Write comment
     */
    protected function comment(string $message): void
    {
        $this->output->comment($message);
    }

    /**
     * Write line
     */
    protected function line(string $message): void
    {
        $this->output->line($message);
    }

    /**
     * Write new line
     */
    protected function newLine(int $count = 1): void
    {
        $this->output->newLine($count);
    }

    /**
     * Display table
     */
    protected function table(array $headers, array $rows): void
    {
        $this->output->table($headers, $rows);
    }

    /**
     * Create progress bar
     */
    protected function progressStart(int $max): void
    {
        $this->output->progressStart($max);
    }

    /**
     * Advance progress bar
     */
    protected function progressAdvance(int $step = 1): void
    {
        $this->output->progressAdvance($step);
    }

    /**
     * Finish progress bar
     */
    protected function progressFinish(): void
    {
        $this->output->progressFinish();
    }

    /**
     * Call another command
     */
    protected function call(string $command, array $arguments = []): int
    {
        return app(Application::class)->call($command, $arguments);
    }
}
