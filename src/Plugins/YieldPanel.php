<?php

declare(strict_types=1);

namespace YieldStudio\FilamentPanel\Plugins;

use Filafly\Icons\Phosphor\PhosphorIcons;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Concerns\EvaluatesClosures;

class YieldPanel implements Plugin
{
    use EvaluatesClosures;

    public string $identifier = 'yield-panel';

    public bool $withSuggestedColors = false;

    public bool $withSuggestedFont = false;

    public bool $withSuggestedIcons = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return $this->identifier;
    }

    public function boot(Panel $panel): void
    {
        // This is called when the panel is in use
    }

    public function register(Panel $panel): void
    {
        if ($this->withSuggestedColors) {
            $this->colorConfiguration($panel);
        }

        if ($this->withSuggestedFont) {
            $this->fontConfiguration($panel);
        }

        if ($this->withSuggestedIcons) {
            $this->iconConfiguration($panel);
        }

        $this->themeConfiguration($panel);
    }

    public function themeConfiguration(Panel $panel): void
    {
        // Theme configuration
    }

    public function colorConfiguration(Panel $panel): void
    {
        $panel->colors([
            'primary' => Color::generatePalette('#027BFC'),
            'secondary' => Color::generatePalette('#151D53'),
        ]);
    }

    public function withSuggestedColors(bool $condition = true): static
    {
        $this->withSuggestedColors = $condition;

        return $this;
    }

    public function fontConfiguration(Panel $panel): void
    {
        $panel->font('Inter');
    }

    public function withSuggestedFont(bool $condition = true): static
    {
        $this->withSuggestedFont = $condition;

        return $this;
    }

    public function iconConfiguration(Panel $panel): void
    {
        $panel->plugin(PhosphorIcons::make()->duotone());
    }

    public function withSuggestedIcons(bool $condition = true): static
    {
        $this->withSuggestedIcons = $condition;

        return $this;
    }
}
