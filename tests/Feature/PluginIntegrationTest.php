<?php

declare(strict_types=1);

use Filament\Panel;
use YieldStudio\FilamentPanel\Plugins\DevelopperLogin;
use YieldStudio\FilamentPanel\Plugins\EnvironmentIndicator;
use YieldStudio\FilamentPanel\Plugins\YieldPanel;

it('can register yield panel plugin', function () {
    $panel = Panel::make();
    $plugin = YieldPanel::make();

    $plugin->register($panel);

    expect($plugin->getId())->toBe('yield-panel');
});

it('can register environment indicator plugin', function () {
    $panel = Panel::make();
    $plugin = EnvironmentIndicator::make();

    $plugin->register($panel);

    expect($plugin->getId())->toBe('yield-environment-indicator');
});

it('can register developper login plugin', function () {
    $panel = Panel::make();
    $plugin = DevelopperLogin::make()
        ->users(['test@test.com']);

    $plugin->register($panel);

    expect($plugin->getId())->toBe('yield-developper-login');
});

it('plugins can be chained on panel', function () {
    $panel = Panel::make();

    $panel
        ->plugin(YieldPanel::make())
        ->plugin(EnvironmentIndicator::make())
        ->plugin(DevelopperLogin::make());

    expect($panel)->toBeInstanceOf(Panel::class);
});

it('yield panel applies colors when configured', function () {
    $panel = Panel::make();
    $plugin = YieldPanel::make()
        ->withSuggestedColors();

    $plugin->register($panel);

    // The panel should have been configured
    expect($plugin->withSuggestedColors)->toBeTrue();
});

it('yield panel applies font when configured', function () {
    $panel = Panel::make();
    $plugin = YieldPanel::make()
        ->withSuggestedFont();

    $plugin->register($panel);

    expect($plugin->withSuggestedFont)->toBeTrue();
});

it('yield panel applies icons when configured', function () {
    $panel = Panel::make();
    $plugin = YieldPanel::make()
        ->withSuggestedIcons();

    $plugin->register($panel);

    expect($plugin->withSuggestedIcons)->toBeTrue();
});
