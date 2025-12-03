<?php

declare(strict_types=1);

use Filament\Support\Colors\Color;
use YieldStudio\FilamentPanel\Plugins\EnvironmentIndicator;

it('can create environment indicator plugin', function () {
    $plugin = EnvironmentIndicator::make();

    expect($plugin)->toBeInstanceOf(EnvironmentIndicator::class);
});

it('has correct plugin identifier', function () {
    $plugin = EnvironmentIndicator::make();

    expect($plugin->getId())->toBe('yield-environment-indicator');
});

it('can set visibility', function () {
    $plugin = EnvironmentIndicator::make()
        ->visible(true);

    expect($plugin->visible)->toBeTrue();
});

it('can set visibility via closure', function () {
    $plugin = EnvironmentIndicator::make()
        ->visible(fn () => true);

    expect($plugin->visible)->toBeInstanceOf(Closure::class);
});

it('can set show badge', function () {
    $plugin = EnvironmentIndicator::make()
        ->showBadge(true);

    expect($plugin->showBadge)->toBeTrue();
});

it('can set show badge via closure', function () {
    $plugin = EnvironmentIndicator::make()
        ->showBadge(fn () => true);

    expect($plugin->showBadge)->toBeInstanceOf(Closure::class);
});

it('can set color', function () {
    $plugin = EnvironmentIndicator::make()
        ->color(Color::Red);

    expect($plugin->color)->toBe(Color::Red);
});

it('can set color via closure', function () {
    $plugin = EnvironmentIndicator::make()
        ->color(fn () => Color::Blue);

    expect($plugin->color)->toBeInstanceOf(Closure::class);
});

it('can set badge position', function () {
    $plugin = EnvironmentIndicator::make()
        ->badgePosition('custom-position');

    expect($plugin->badgePosition)->toBe('custom-position');
});

it('can chain configuration methods', function () {
    $plugin = EnvironmentIndicator::make()
        ->visible(true)
        ->showBadge(true)
        ->color(Color::Red)
        ->badgePosition('custom-position');

    expect($plugin->visible)->toBeTrue();
    expect($plugin->showBadge)->toBeTrue();
    expect($plugin->color)->toBe(Color::Red);
    expect($plugin->badgePosition)->toBe('custom-position');
});

it('has default configuration', function () {
    $plugin = EnvironmentIndicator::make();

    expect($plugin->visible)->toBeInstanceOf(Closure::class);
    expect($plugin->color)->toBeInstanceOf(Closure::class);
    expect($plugin->showBadge)->toBeInstanceOf(Closure::class);
});

it('has getBadgePosition method with default', function () {
    $plugin = EnvironmentIndicator::make();

    // Use reflection to access protected method
    $reflection = new \ReflectionClass($plugin);
    $method = $reflection->getMethod('getBadgePosition');
    $method->setAccessible(true);

    $position = $method->invoke($plugin);
    expect($position)->toBeString();
});

it('uses custom badge position when set', function () {
    $plugin = EnvironmentIndicator::make()
        ->badgePosition('custom-position');

    $reflection = new \ReflectionClass($plugin);
    $method = $reflection->getMethod('getBadgePosition');
    $method->setAccessible(true);

    expect($method->invoke($plugin))->toBe('custom-position');
});

it('has getColor method', function () {
    $plugin = EnvironmentIndicator::make()
        ->color(Color::Red);

    $reflection = new \ReflectionClass($plugin);
    $method = $reflection->getMethod('getColor');
    $method->setAccessible(true);

    expect($method->invoke($plugin))->toBe(Color::Red);
});

it('calls boot method', function () {
    $panel = \Filament\Panel::make();
    $plugin = EnvironmentIndicator::make();

    $plugin->boot($panel);

    expect($plugin)->toBeInstanceOf(EnvironmentIndicator::class);
});
