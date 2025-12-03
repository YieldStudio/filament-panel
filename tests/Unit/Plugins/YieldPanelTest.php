<?php

declare(strict_types=1);

use YieldStudio\FilamentPanel\Plugins\YieldPanel;

it('can create yield panel plugin', function () {
    $plugin = YieldPanel::make();

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});

it('has correct plugin identifier', function () {
    $plugin = YieldPanel::make();

    expect($plugin->getId())->toBe('yield-panel');
});

it('can enable suggested colors', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedColors();

    expect($plugin->withSuggestedColors)->toBeTrue();
});

it('can disable suggested colors', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedColors(false);

    expect($plugin->withSuggestedColors)->toBeFalse();
});

it('can enable suggested font', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedFont();

    expect($plugin->withSuggestedFont)->toBeTrue();
});

it('can disable suggested font', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedFont(false);

    expect($plugin->withSuggestedFont)->toBeFalse();
});

it('can enable suggested icons', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedIcons();

    expect($plugin->withSuggestedIcons)->toBeTrue();
});

it('can disable suggested icons', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedIcons(false);

    expect($plugin->withSuggestedIcons)->toBeFalse();
});

it('has suggested colors disabled by default', function () {
    $plugin = YieldPanel::make();

    expect($plugin->withSuggestedColors)->toBeFalse();
});

it('has suggested font disabled by default', function () {
    $plugin = YieldPanel::make();

    expect($plugin->withSuggestedFont)->toBeFalse();
});

it('has suggested icons disabled by default', function () {
    $plugin = YieldPanel::make();

    expect($plugin->withSuggestedIcons)->toBeFalse();
});

it('can chain configuration methods', function () {
    $plugin = YieldPanel::make()
        ->withSuggestedColors()
        ->withSuggestedFont()
        ->withSuggestedIcons();

    expect($plugin->withSuggestedColors)->toBeTrue();
    expect($plugin->withSuggestedFont)->toBeTrue();
    expect($plugin->withSuggestedIcons)->toBeTrue();
});

it('has color configuration method', function () {
    $panel = \Filament\Panel::make();
    $plugin = YieldPanel::make()->withSuggestedColors();

    $plugin->colorConfiguration($panel);

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});

it('has font configuration method', function () {
    $panel = \Filament\Panel::make();
    $plugin = YieldPanel::make()->withSuggestedFont();

    $plugin->fontConfiguration($panel);

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});

it('has icon configuration method', function () {
    $panel = \Filament\Panel::make();
    $plugin = YieldPanel::make()->withSuggestedIcons();

    $plugin->iconConfiguration($panel);

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});

it('has theme configuration method', function () {
    $panel = \Filament\Panel::make();
    $plugin = YieldPanel::make();

    $plugin->themeConfiguration($panel);

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});

it('calls boot method', function () {
    $panel = \Filament\Panel::make();
    $plugin = YieldPanel::make();

    $plugin->boot($panel);

    expect($plugin)->toBeInstanceOf(YieldPanel::class);
});
