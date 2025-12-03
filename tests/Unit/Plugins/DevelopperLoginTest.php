<?php

declare(strict_types=1);

use YieldStudio\FilamentPanel\Plugins\DevelopperLogin;

it('can create developper login plugin', function () {
    $plugin = DevelopperLogin::make();

    expect($plugin)->toBeInstanceOf(DevelopperLogin::class);
});

it('has correct plugin identifier', function () {
    $plugin = DevelopperLogin::make();

    expect($plugin->getId())->toBe('yield-developper-login');
});

it('can enable the plugin', function () {
    $plugin = DevelopperLogin::make()
        ->enabled(true);

    expect($plugin->enabled)->toBeTrue();
});

it('can disable the plugin', function () {
    $plugin = DevelopperLogin::make()
        ->enabled(false);

    expect($plugin->enabled)->toBeFalse();
});

it('can set enabled via closure', function () {
    $plugin = DevelopperLogin::make()
        ->enabled(fn () => app()->isLocal());

    expect($plugin->enabled)->toBeInstanceOf(Closure::class);
});

it('can set users array', function () {
    $users = [
        ['email' => 'admin@test.com', 'name' => 'Admin'],
        ['email' => 'user@test.com', 'name' => 'User'],
    ];

    $plugin = DevelopperLogin::make()
        ->users($users);

    expect($plugin->users)->toBe($users);
});

it('can set users via closure', function () {
    $plugin = DevelopperLogin::make()
        ->users(fn () => [['email' => 'test@test.com']]);

    expect($plugin->users)->toBeInstanceOf(Closure::class);
});

it('can set model class', function () {
    $plugin = DevelopperLogin::make()
        ->modelClass('App\\Models\\CustomUser');

    expect($plugin->modelClass)->toBe('App\\Models\\CustomUser');
});

it('can set model class via closure', function () {
    $plugin = DevelopperLogin::make()
        ->modelClass(fn () => 'App\\Models\\User');

    expect($plugin->modelClass)->toBeInstanceOf(Closure::class);
});

it('has default enabled state as closure', function () {
    $plugin = DevelopperLogin::make();

    expect($plugin->enabled)->toBeInstanceOf(Closure::class);
});

it('has default model class', function () {
    $plugin = DevelopperLogin::make();

    expect($plugin->modelClass)->toBeString();
    expect($plugin->modelClass)->toContain('User');
});

it('can chain configuration methods', function () {
    $plugin = DevelopperLogin::make()
        ->enabled(true)
        ->users([['email' => 'test@test.com']])
        ->modelClass('App\\Models\\User');

    expect($plugin->enabled)->toBeTrue();
    expect($plugin->users)->toBeArray();
    expect($plugin->modelClass)->toBe('App\\Models\\User');
});

it('has getUsers method', function () {
    $users = [['email' => 'admin@test.com'], ['email' => 'user@test.com']];
    $plugin = DevelopperLogin::make()
        ->users($users);

    $reflection = new \ReflectionClass($plugin);
    $method = $reflection->getMethod('getUsers');
    $method->setAccessible(true);

    expect($method->invoke($plugin))->toBe($users);
});

it('evaluates users closure', function () {
    $plugin = DevelopperLogin::make()
        ->users(fn () => [['email' => 'dynamic@test.com']]);

    $reflection = new \ReflectionClass($plugin);
    $method = $reflection->getMethod('getUsers');
    $method->setAccessible(true);

    expect($method->invoke($plugin))->toBe([['email' => 'dynamic@test.com']]);
});

it('calls boot method', function () {
    $panel = \Filament\Panel::make();
    $plugin = DevelopperLogin::make();

    $plugin->boot($panel);

    expect($plugin)->toBeInstanceOf(DevelopperLogin::class);
});
