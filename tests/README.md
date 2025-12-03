# Tests Documentation

Ce document décrit la structure et l'organisation des tests pour le package Filament Panel.

## Structure des Tests

```
tests/
├── Pest.php                    # Configuration Pest
├── Arch/                       # Tests d'architecture
│   └── ArchTest.php
├── Unit/                       # Tests unitaires
│   ├── Actions/
│   │   └── CopyActionTest.php
│   ├── Livewire/
│   │   └── DevelopperLoginComponentTest.php
│   ├── Plugins/
│   │   ├── DevelopperLoginTest.php
│   │   ├── EnvironmentIndicatorTest.php
│   │   └── YieldPanelTest.php
│   ├── Tables/
│   │   └── Columns/
│   │       └── ProgressBarColumnTest.php
│   └── ViewsTest.php
└── Feature/                    # Tests d'intégration
    ├── PluginIntegrationTest.php
    ├── ServiceProviderTest.php
    └── TranslationsTest.php
```

## Exécution des Tests

### Tous les tests
```bash
composer test
# ou
vendor/bin/pest
```

### Tests avec couverture de type
```bash
composer type
# ou
vendor/bin/pest --type-coverage
```

### Tests spécifiques
```bash
# Tests unitaires uniquement
vendor/bin/pest tests/Unit

# Tests d'architecture uniquement
vendor/bin/pest tests/Arch

# Tests de feature uniquement
vendor/bin/pest tests/Feature

# Un fichier spécifique
vendor/bin/pest tests/Unit/Actions/CopyActionTest.php
```

### Avec verbosité
```bash
vendor/bin/pest --verbose
```

## Types de Tests

### Tests d'Architecture (Arch Tests)

Les tests d'architecture vérifient la qualité et la cohérence du code :

- ✅ Pas de fonctions de débogage (`dd`, `dump`, `ray`, etc.)
- ✅ Les plugins implémentent l'interface `Plugin`
- ✅ Les actions étendent la classe `Action`
- ✅ Les colonnes étendent la classe `Column`
- ✅ Les composants Livewire étendent `Component`
- ✅ Utilisation de `strict_types`
- ✅ Pas d'utilisation de globals dangereux

### Tests Unitaires

#### CopyAction
- Création de l'action
- Configuration de la valeur à copier
- Messages de notification
- Tooltips
- Click handlers

#### ProgressBarColumn
- Configuration des couleurs
- Valeurs max et seuils
- Labels personnalisés
- Normalisation des couleurs
- Support des closures

#### Plugins (YieldPanel, EnvironmentIndicator, DevelopperLogin)
- Création et identification
- Configuration des options
- Chaînage de méthodes
- Valeurs par défaut
- Support des closures

#### Livewire Components
- Montage des composants
- Propriétés
- Rendu des vues
- Events

### Tests de Feature

#### ServiceProvider
- Enregistrement du provider
- Composants Livewire
- Assets CSS
- Traductions
- Vues

#### PluginIntegration
- Enregistrement des plugins
- Configuration des panels
- Chaînage des plugins

#### Translations
- Présence des fichiers de traduction
- Structure des traductions
- Support multilingue (EN, FR)

## Conventions

### Nomenclature
- Les tests utilisent la syntaxe Pest "it/test"
- Format : `it('does something', function () { ... })`
- Descriptions claires et concises en anglais

### Assertions
- Utiliser les expectations Pest : `expect($value)->toBe(...)`
- Préférer les assertions expressives
- Un concept par test

### Fixtures et Setup
- Utiliser `beforeEach()` pour la configuration commune
- Éviter les dépendances entre tests
- Chaque test doit être indépendant

## Exemples de Tests

### Test Simple
```php
it('can create a copy action', function () {
    $action = CopyAction::make();

    expect($action)->toBeInstanceOf(CopyAction::class);
});
```

### Test avec Configuration
```php
it('can set copyable value', function () {
    $action = CopyAction::make()
        ->copyable('test value');

    expect($action->getCopyable())->toBe('test value');
});
```

### Test avec Closure
```php
it('can set copyable via closure', function () {
    $action = CopyAction::make()
        ->copyable(fn () => 'dynamic value');

    expect($action->getCopyable())->toBe('dynamic value');
});
```

### Test d'Architecture
```php
arch('plugins implement Plugin interface')
    ->expect('YieldStudio\FilamentPanel\Plugins')
    ->toImplement(Filament\Contracts\Plugin::class);
```

## Couverture

Pour générer un rapport de couverture :

```bash
vendor/bin/pest --coverage
```

## Debugging

Pour voir les valeurs pendant les tests :

```bash
# Avec dump
expect($value)->dump()->toBe('expected');

# Avec dd (stop l'exécution)
expect($value)->dd();
```

## CI/CD

Les tests sont exécutés automatiquement via :

```bash
composer finalize
```

Cette commande exécute :
1. Refactoring (Rector)
2. Linting (Pint)
3. Type Coverage (Pest)
4. Analyse statique (PHPStan)
5. Tests (Pest)

## Ressources

- [Pest Documentation](https://pestphp.com)
- [Filament Testing](https://filamentphp.com/docs/support/testing)
- [Laravel Testing](https://laravel.com/docs/testing)
