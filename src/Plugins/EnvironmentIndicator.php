<?php

declare(strict_types=1);

namespace YieldStudio\FilamentPanel\Plugins;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\View\PanelsRenderHook;

class EnvironmentIndicator implements Plugin
{
    use EvaluatesClosures;

    public string $identifier = 'yield-environment-indicator';

    public bool | Closure | null $visible = null;

    public bool | Closure | null $showBadge = null;

    public array | Closure | null $color = null;

    public ?string $badgePosition = null;

    public static function make(): static
    {
        $plugin = app(static::class);

        // Defaults
        $plugin->visible(function () {
            if (($user = auth()->user()) === null) {
                return false;
            }

            if (method_exists($user, 'hasRole')) {
                return $user->hasRole('super_admin');
            }

            return true;
        });

        $plugin->color(fn (): array => match (app()->environment()) {
            'production' => Color::Red,
            'staging' => Color::Orange,
            'development' => Color::Blue,
            default => Color::Blue,
        });

        $plugin->showBadge(fn (): bool => match (app()->environment()) {
            'production' => false,
            default => true,
        });

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
        $panel->renderHook($this->getBadgePosition(), function (): string {
            $html = '';

            if (! $this->evaluate($this->visible)) {
                return $html;
            }

            if ($this->evaluate($this->showBadge)) {
                $html .= view('yield-panel::environment-indicator.badge', [
                    'color' => $this->getColor(),
                    'environment' => ucfirst(app()->environment()),
                ])->render();
            }

            return $html;
        });
    }

    public function visible(bool | Closure $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function showBadge(bool | Closure $showBadge = true): static
    {
        $this->showBadge = $showBadge;

        return $this;
    }

    public function color(array | Closure $color = Color::Pink): static
    {
        $this->color = $color;

        return $this;
    }

    public function badgePosition(string $position): static
    {
        $this->badgePosition = $position;

        return $this;
    }

    protected function getBadgePosition(): string
    {
        return $this->badgePosition ?: PanelsRenderHook::GLOBAL_SEARCH_BEFORE;
    }

    protected function getColor(): array
    {
        return (array) $this->evaluate($this->color);
    }
}
