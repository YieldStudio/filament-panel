<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it('has english translations', function () {
    $enPath = __DIR__ . '/../../resources/lang/en';

    expect(File::isDirectory($enPath))->toBeTrue();
});

it('has french translations', function () {
    $frPath = __DIR__ . '/../../resources/lang/fr';

    expect(File::isDirectory($frPath))->toBeTrue();
});

it('has copy action translations in english', function () {
    $translations = include __DIR__ . '/../../resources/lang/en/actions.php';

    expect($translations)->toBeArray();
    expect($translations)->toHaveKey('copy');
    expect($translations['copy'])->toHaveKey('label');
    expect($translations['copy'])->toHaveKey('copied');
});

it('has copy action translations in french', function () {
    $translations = include __DIR__ . '/../../resources/lang/fr/actions.php';

    expect($translations)->toBeArray();
    expect($translations)->toHaveKey('copy');
    expect($translations['copy'])->toHaveKey('label');
    expect($translations['copy'])->toHaveKey('copied');
});

it('has developper login translations in english', function () {
    $enFiles = File::files(__DIR__ . '/../../resources/lang/en');
    $hasDevLoginFile = collect($enFiles)->contains(fn ($file) => str_contains($file->getFilename(), 'developper-login'));

    expect($hasDevLoginFile)->toBeTrue();
});

it('has developper login translations in french', function () {
    $frFiles = File::files(__DIR__ . '/../../resources/lang/fr');
    $hasDevLoginFile = collect($frFiles)->contains(fn ($file) => str_contains($file->getFilename(), 'developper-login'));

    expect($hasDevLoginFile)->toBeTrue();
});
