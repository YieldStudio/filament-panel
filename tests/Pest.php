<?php

declare(strict_types=1);

use Orchestra\Testbench\TestCase;
use YieldStudio\FilamentPanel\FilamentPanelServiceProvider;

uses(TestCase::class)->in(__DIR__);

// Setup function for all tests
uses()->beforeEach(function () {
    //
})->in(__DIR__);

// Get package providers
function getPackageProviders($app)
{
    return [
        FilamentPanelServiceProvider::class,
        \Filament\FilamentServiceProvider::class,
        \Livewire\LivewireServiceProvider::class,
    ];
}

// Define environment setup
function getEnvironmentSetUp($app)
{
    config()->set('database.default', 'testing');
    config()->set('app.key', 'base64:' . base64_encode(random_bytes(32)));
}
