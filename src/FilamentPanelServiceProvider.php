<?php

declare(strict_types=1);

namespace YieldStudio\FilamentPanel;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use YieldStudio\FilamentPanel\Livewire\Components\DevelopperLogin;

class FilamentPanelServiceProvider extends PackageServiceProvider
{
    public static string $name = 'yield-panel';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(self::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        Livewire::component('developper-login', DevelopperLogin::class);

        FilamentAsset::register([
            Css::make('environment-indicator', __DIR__ . '/../resources/css/environment-indicator.css'),
        ], static::$name);
    }
}
