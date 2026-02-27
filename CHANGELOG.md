# Changelog

All notable changes to `filament-panel` will be documented in this file.

## 0.0.2 - 2026-02-27

### What's Changed

* Bump actions/checkout from 5 to 6 by @dependabot[bot] in https://github.com/YieldStudio/filament-panel/pull/1
* Bump stefanzweifel/git-auto-commit-action from 4 to 7 by @dependabot[bot] in https://github.com/YieldStudio/filament-panel/pull/2
* Bump dependabot/fetch-metadata from 2.4.0 to 2.5.0 by @dependabot[bot] in https://github.com/YieldStudio/filament-panel/pull/3

### New Contributors

* @dependabot[bot] made their first contribution in https://github.com/YieldStudio/filament-panel/pull/1

**Full Changelog**: https://github.com/YieldStudio/filament-panel/compare/0.0.1...0.0.2

## Initial Release - 2025-12-03

### 🎉 First Release

This is the first stable release of the Filament Panel package - a comprehensive extension for Filament v4 admin panels.

### ✨ Features

#### YieldPanel Plugin

- **Custom Color Schemes**: Apply custom color palettes to your Filament panels
- **Font Configuration**: Configure custom fonts for your admin interface
- **Icon Customization**: Support for Phosphor Icons integration
- **Theme System**: Modern theme support with CSS customization

#### Environment Indicator Plugin

- **Visual Environment Badge**: Display environment badges (local, staging, production) in the admin panel
- **Customizable Position**: Configure badge position (top-left, top-right, bottom-left, bottom-right)
- **Custom Colors**: Set custom colors for different environments
- **Toggle Visibility**: Show/hide the indicator based on environment or custom logic

#### Developer Login Plugin

- **Quick Login**: Rapid authentication for development environments
- **User Selection**: Configure allowed development users
- **Custom Model Support**: Works with any authentication model
- **Secure by Design**: Automatically disabled in production (configurable)

#### Custom Components

##### CopyAction

- **Copy to Clipboard**: One-click copy action for table rows and forms
- **Custom Notifications**: Configurable success messages
- **Icon Support**: Phosphor Icons integration
- **Flexible Configuration**: Works with closures for dynamic content

##### ProgressBarColumn

- **Visual Progress Indicators**: Display progress bars in table columns
- **Status-Based Colors**: Automatic color coding (success, warning, danger)
- **Custom Thresholds**: Configure low stock/threshold warnings
- **Dynamic Labels**: Show custom labels based on status
- **Flexible Values**: Support for static or dynamic max values

### 🧪 Testing

- **133 Tests**: Comprehensive test suite with 166 assertions
- **55.5% Code Coverage**: Unit and feature tests
- **Architecture Tests**: Ensures code quality and best practices
- **Pest Framework**: Modern PHP testing with Pest v3

### 📦 Package Details

- **PHP Compatibility**: 8.2, 8.3, 8.4
- **Laravel Compatibility**: 11.x, 12.x
- **Filament Version**: v4.x
- **Testing Framework**: Pest ^2.0|^3.0
- **Code Quality**: PHPStan Level 9, Laravel Pint

### 🔧 Bug Fixes

- Fixed `mb_trim()` compatibility issue for PHP 8.2/8.3 (601fd32)

### 📚 Documentation

- Comprehensive README with installation and usage instructions
- Test suite documentation
- Code coverage setup guide
- Coverage improvement recommendations

### 🚀 Installation

```bash
composer require yieldstudio/filament-panel


```
### 📖 Usage Example

```php
use YieldStudio\FilamentPanel\Plugins\YieldPanel;
use YieldStudio\FilamentPanel\Plugins\EnvironmentIndicator;
use YieldStudio\FilamentPanel\Plugins\DevelopperLogin;

$panel
    ->plugin(
        YieldPanel::make()
            ->useSuggestedColors()
            ->useSuggestedFont()
            ->useSuggestedIcons()
    )
    ->plugin(
        EnvironmentIndicator::make()
            ->visible(fn () => app()->environment(['local', 'staging']))
            ->color(fn () => match (app()->environment()) {
                'local' => 'rgb(34, 197, 94)',
                'staging' => 'rgb(251, 146, 60)',
                default => 'rgb(244, 63, 94)',
            })
    )
    ->plugin(
        DevelopperLogin::make()
            ->users(['admin@example.com', 'dev@example.com'])
    );


```