<?php

declare(strict_types=1);

use Filament\Support\Colors\Color;
use YieldStudio\FilamentPanel\Tables\Columns\ProgressBarColumn;

beforeEach(function () {
    $this->column = ProgressBarColumn::make('stock');
});

it('can create a progress bar column', function () {
    expect($this->column)->toBeInstanceOf(ProgressBarColumn::class);
});

it('has default danger color', function () {
    expect($this->column->getDangerColor())->toBe('rgb(244, 63, 94)');
});

it('has default warning color', function () {
    expect($this->column->getWarningColor())->toBe('rgb(251, 146, 60)');
});

it('has default success color', function () {
    expect($this->column->getSuccessColor())->toBe('rgb(34, 197, 94)');
});

it('can set max value', function () {
    $this->column->maxValue(100);

    expect($this->column->getMaxValue())->toBe(100);
});

it('can set max value via closure', function () {
    $this->column->maxValue(fn () => 200);

    expect($this->column->getMaxValue())->toBe(200);
});

it('can set low threshold', function () {
    $this->column->lowThreshold(20);

    expect($this->column->getLowThreshold())->toBe(20);
});

it('can set low threshold via closure', function () {
    $this->column->lowThreshold(fn () => 30);

    expect($this->column->getLowThreshold())->toBe(30);
});

it('can set custom danger color', function () {
    $this->column->dangerColor('rgb(255, 0, 0)');

    expect($this->column->getDangerColor())->toBe('rgb(255, 0, 0)');
});

it('can set custom warning color', function () {
    $this->column->warningColor('rgb(255, 165, 0)');

    expect($this->column->getWarningColor())->toBe('rgb(255, 165, 0)');
});

it('can set custom success color', function () {
    $this->column->successColor('rgb(0, 255, 0)');

    expect($this->column->getSuccessColor())->toBe('rgb(0, 255, 0)');
});

it('can set danger label as string', function () {
    $this->column->dangerLabel('Out of stock');

    expect($this->column->getDangerLabel(0))->toBe('Out of stock');
});

it('can set danger label as closure', function () {
    $this->column->dangerLabel(fn ($state) => $state <= 0 ? 'Empty' : 'Low: ' . $state);

    expect($this->column->getDangerLabel(0))->toBe('Empty');
    expect($this->column->getDangerLabel(5))->toBe('Low: 5');
});

it('can set warning label', function () {
    $this->column->warningLabel('Low stock');

    expect($this->column->getWarningLabel(10))->toBe('Low stock');
});

it('can set warning label as closure', function () {
    $this->column->warningLabel(fn ($state) => $state . ' items remaining');

    expect($this->column->getWarningLabel(15))->toBe('15 items remaining');
});

it('can set success label', function () {
    $this->column->successLabel('In stock');

    expect($this->column->getSuccessLabel(50))->toBe('In stock');
});

it('can set success label as closure', function () {
    $this->column->successLabel(fn ($state) => $state . ' available');

    expect($this->column->getSuccessLabel(100))->toBe('100 available');
});

it('accepts closure for colors', function () {
    $this->column->dangerColor(fn () => 'rgb(200, 0, 0)');

    expect($this->column->getDangerColor())->toBe('rgb(200, 0, 0)');
});

it('normalizes hex colors to rgb', function () {
    $this->column->dangerColor('#FF0000');

    $color = $this->column->getDangerColor();
    expect($color)->toBeString();
    expect($color)->toContain('rgb');
});

it('keeps rgb colors unchanged', function () {
    $rgbColor = 'rgb(100, 100, 100)';
    $this->column->dangerColor($rgbColor);

    expect($this->column->getDangerColor())->toBe($rgbColor);
});

it('accepts array colors', function () {
    $colorArray = Color::Red;
    $this->column->dangerColor($colorArray);

    expect($this->column->getDangerColor())->toBe($colorArray);
});

it('returns null for max value when not set', function () {
    expect($this->column->getMaxValue())->toBeNull();
});

it('returns null for low threshold when not set', function () {
    expect($this->column->getLowThreshold())->toBeNull();
});

it('can chain method calls', function () {
    $column = ProgressBarColumn::make('stock')
        ->maxValue(100)
        ->lowThreshold(20)
        ->dangerColor('rgb(255, 0, 0)')
        ->warningColor('rgb(255, 165, 0)')
        ->successColor('rgb(0, 255, 0)');

    expect($column->getMaxValue())->toBe(100);
    expect($column->getLowThreshold())->toBe(20);
    expect($column->getDangerColor())->toBe('rgb(255, 0, 0)');
});

it('has correct view path', function () {
    expect($this->column->getView())->toBe('yield-panel::columns.progress-bar-column');
});

// Tests for getProgressStatus, getProgressPercentage, getProgressLabel et getProgressColor
// Note: Ces méthodes dépendent de getState() qui nécessite un contexte de table Filament
// Nous testons plutôt la logique des méthodes auxiliaires
