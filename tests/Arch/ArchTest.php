<?php

declare(strict_types=1);

arch('does not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
    ->not->toBeUsed();

arch('plugins implement Plugin interface')
    ->expect('YieldStudio\FilamentPanel\Plugins')
    ->toImplement(Filament\Contracts\Plugin::class);

arch('actions extend Action class')
    ->expect('YieldStudio\FilamentPanel\Actions')
    ->toExtend(Filament\Actions\Action::class);

arch('columns extend Column class')
    ->expect('YieldStudio\FilamentPanel\Tables\Columns')
    ->toExtend(Filament\Tables\Columns\Column::class);

arch('livewire components extend Component class')
    ->expect('YieldStudio\FilamentPanel\Livewire\Components')
    ->toExtend(Livewire\Component::class);

arch('uses strict types')
    ->expect('YieldStudio\FilamentPanel')
    ->toUseStrictTypes();

arch('service providers extend ServiceProvider')
    ->expect('YieldStudio\FilamentPanel\FilamentPanelServiceProvider')
    ->toExtend(Spatie\LaravelPackageTools\PackageServiceProvider::class);

arch('does not use globals')
    ->expect('YieldStudio\FilamentPanel')
    ->not->toUse(['global', 'eval', 'extract']);

// Skipping final/abstract test for plugins as they need to be extensible
// arch('classes are final or abstract')
//     ->expect('YieldStudio\FilamentPanel\Plugins')
//     ->toBeFinal();
