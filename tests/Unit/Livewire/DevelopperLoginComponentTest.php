<?php

declare(strict_types=1);

use YieldStudio\FilamentPanel\Livewire\Components\DevelopperLogin;

it('can mount component with users and model class', function () {
    $users = [
        'admin@test.com',
        'user@test.com',
    ];
    $modelClass = 'App\\Models\\User';

    $component = new DevelopperLogin;
    $component->mount($users, $modelClass);

    expect($component->users)->toBe($users);
    expect($component->modelClass)->toBe($modelClass);
});

it('can instantiate component', function () {
    $component = new DevelopperLogin;

    expect($component)->toBeInstanceOf(DevelopperLogin::class);
});

it('has loginAsDevelopper method', function () {
    $component = new DevelopperLogin;

    expect(method_exists($component, 'loginAsDevelopper'))->toBeTrue();
});

it('has users property', function () {
    $component = new DevelopperLogin;

    expect($component)->toHaveProperty('users');
});

it('has model class property', function () {
    $component = new DevelopperLogin;

    expect($component)->toHaveProperty('modelClass');
});

it('listens for loginAsDevelopper event', function () {
    $reflection = new \ReflectionClass(DevelopperLogin::class);
    $method = $reflection->getMethod('loginAsDevelopper');
    $attributes = $method->getAttributes();

    expect($attributes)->not->toBeEmpty();
    expect($attributes[0]->getName())->toBe(\Livewire\Attributes\On::class);
});

it('has render method', function () {
    $component = new DevelopperLogin;

    expect(method_exists($component, 'render'))->toBeTrue();
});

it('mount sets users property correctly', function () {
    $users = ['user@example.com', 'admin@example.com'];
    $component = new DevelopperLogin;
    $component->mount($users, 'App\\Models\\User');

    expect($component->users)->toBe($users);
});

it('mount sets modelClass property correctly', function () {
    $component = new DevelopperLogin;
    $component->mount([], 'App\\Models\\User');

    expect($component->modelClass)->toBe('App\\Models\\User');
});
