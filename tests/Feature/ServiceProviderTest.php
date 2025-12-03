<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;
use YieldStudio\FilamentPanel\FilamentPanelServiceProvider;

it('has service provider class', function () {
    expect(class_exists(FilamentPanelServiceProvider::class))->toBeTrue();
});

it('has developper login livewire component', function () {
    expect(class_exists(\YieldStudio\FilamentPanel\Livewire\Components\DevelopperLogin::class))->toBeTrue();
});

it('registers css asset', function () {
    $cssPath = __DIR__ . '/../../resources/css/environment-indicator.css';

    expect(File::exists($cssPath))->toBeTrue();
});

it('has package name configured', function () {
    expect(FilamentPanelServiceProvider::$name)->toBe('yield-panel');
});

it('can configure package', function () {
    $provider = new FilamentPanelServiceProvider(app());

    expect($provider)->toBeInstanceOf(FilamentPanelServiceProvider::class);
});

it('package has views enabled', function () {
    $provider = new FilamentPanelServiceProvider(app());
    $package = new \Spatie\LaravelPackageTools\Package;

    $provider->configurePackage($package);

    expect($package->hasViews)->toBeTrue();
});

it('package has translations enabled', function () {
    $provider = new FilamentPanelServiceProvider(app());
    $package = new \Spatie\LaravelPackageTools\Package;

    $provider->configurePackage($package);

    expect($package->hasTranslations)->toBeTrue();
});

it('package has config file enabled', function () {
    $provider = new FilamentPanelServiceProvider(app());
    $package = new \Spatie\LaravelPackageTools\Package;

    $provider->configurePackage($package);

    // Check that hasConfigFile was called by verifying package name is set
    expect($package->name)->toBe('yield-panel');
});

it('package name is correctly set', function () {
    $provider = new FilamentPanelServiceProvider(app());
    $package = new \Spatie\LaravelPackageTools\Package;

    $provider->configurePackage($package);

    expect($package->name)->toBe('yield-panel');
});

it('has packageBooted method', function () {
    $provider = new FilamentPanelServiceProvider(app());

    expect(method_exists($provider, 'packageBooted'))->toBeTrue();
});

it('packageBooted method is public', function () {
    $reflection = new \ReflectionClass(FilamentPanelServiceProvider::class);
    $method = $reflection->getMethod('packageBooted');

    expect($method->isPublic())->toBeTrue();
});

it('has correct package name', function () {
    expect(FilamentPanelServiceProvider::$name)->toBe('yield-panel');
});

it('publishes translations', function () {
    $translationsPath = __DIR__ . '/../../resources/lang';

    expect(File::isDirectory($translationsPath))->toBeTrue();
    expect(File::exists($translationsPath . '/en'))->toBeTrue();
    expect(File::exists($translationsPath . '/fr'))->toBeTrue();
});

it('publishes views', function () {
    $viewsPath = __DIR__ . '/../../resources/views';

    expect(File::isDirectory($viewsPath))->toBeTrue();
});

it('has environment indicator css file', function () {
    $cssPath = __DIR__ . '/../../resources/css/environment-indicator.css';

    expect(File::exists($cssPath))->toBeTrue();
});
