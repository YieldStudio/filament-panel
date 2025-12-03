<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it('has progress bar column view', function () {
    $viewPath = __DIR__ . '/../../resources/views/columns/progress-bar-column.blade.php';

    expect(File::exists($viewPath))->toBeTrue();
});

it('has environment indicator badge view', function () {
    $viewPath = __DIR__ . '/../../resources/views/environment-indicator';

    expect(File::isDirectory($viewPath))->toBeTrue();
});

it('has developper login component view', function () {
    $viewPath = __DIR__ . '/../../resources/views/livewire/components';

    expect(File::isDirectory($viewPath))->toBeTrue();
});

it('views directory exists', function () {
    $viewsPath = __DIR__ . '/../../resources/views';

    expect(File::isDirectory($viewsPath))->toBeTrue();
});

it('has columns directory in views', function () {
    $columnsPath = __DIR__ . '/../../resources/views/columns';

    expect(File::isDirectory($columnsPath))->toBeTrue();
});

it('has livewire directory in views', function () {
    $livewirePath = __DIR__ . '/../../resources/views/livewire';

    expect(File::isDirectory($livewirePath))->toBeTrue();
});
