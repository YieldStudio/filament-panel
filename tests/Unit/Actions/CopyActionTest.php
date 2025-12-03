<?php

declare(strict_types=1);

use YieldStudio\FilamentPanel\Actions\CopyAction;

it('can create a copy action', function () {
    $action = CopyAction::make();

    expect($action)->toBeInstanceOf(CopyAction::class);
});

it('has correct default name', function () {
    expect(CopyAction::getDefaultName())->toBe('copy');
});

it('can set copyable value', function () {
    $action = CopyAction::make()
        ->copyable('test value');

    expect($action->getCopyable())->toBe('test value');
});

it('can set copyable via closure', function () {
    $action = CopyAction::make()
        ->copyable(fn () => 'dynamic value');

    expect($action->getCopyable())->toBe('dynamic value');
});

it('has default success notification title', function () {
    $action = CopyAction::make();

    expect($action->getSuccessNotificationTitle())->toBe('yield-panel::actions.copy.copied');
});

it('can customize success notification title', function () {
    $action = CopyAction::make()
        ->successNotificationTitle('Custom copied message');

    expect($action->getSuccessNotificationTitle())->toBe('Custom copied message');
});

it('has tooltip by default', function () {
    $action = CopyAction::make();

    expect($action->getTooltip())->toBe('yield-panel::actions.copy.label');
});

it('generates copyable click handler', function () {
    $action = CopyAction::make();
    $handler = $action->getCopyableClickHandler();

    expect($handler)->toBeInstanceOf(Closure::class);
});

it('can set custom action', function () {
    $called = false;
    $action = CopyAction::make()
        ->action(function () use (&$called) {
            $called = true;
        });

    expect($action)->toBeInstanceOf(CopyAction::class);
});
