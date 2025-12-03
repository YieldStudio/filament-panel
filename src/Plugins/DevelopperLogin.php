<?php

declare(strict_types=1);

namespace YieldStudio\FilamentPanel\Plugins;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\View\PanelsRenderHook;
use Livewire\Livewire;

class DevelopperLogin implements Plugin
{
    use EvaluatesClosures;

    public string $identifier = 'yield-developper-login';

    public bool | Closure | null $enabled = null;

    public array | Closure $users = [];

    public string | Closure | null $modelClass = null;

    public ?string $badgePosition = null;

    public static function make(): static
    {
        $plugin = app(static::class);

        // Defaults
        $plugin->enabled(fn () => app()->isLocal());

        $plugin->modelClass(\App\Models\User::class); // @phpstan-ignore-line

        return $plugin;
    }

    public function getId(): string
    {
        return $this->identifier;
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function register(Panel $panel): void
    {
        $panel->renderHook(PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, function () use ($panel): string {
            $html = '';

            if (! $this->evaluate($this->enabled)) {
                return $html;
            }

            if (filled($this->getUsers())) {
                $html .= Livewire::mount('developper-login', [
                    'users' => $this->getUsers(),
                    'modelClass' => $this->evaluate($this->modelClass),
                    'panel' => $panel->getId(),
                ], 'developper-login');
            }

            return $html;
        });
    }

    public function enabled(bool | Closure $condition): static
    {
        $this->enabled = $condition;

        return $this;
    }

    public function users(array | Closure $users = []): static
    {
        $this->users = $users;

        return $this;
    }

    public function modelClass(string | Closure $modelClass): static
    {
        $this->modelClass = $modelClass;

        return $this;
    }

    protected function getUsers(): array
    {
        return (array) $this->evaluate($this->users);
    }
}
