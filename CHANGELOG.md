# Changelog

All notable changes to `enum-helper` will be documented in this file.

## v0.6.0 - 2022-06-18

- moved the Laravel part of package to new `laravel-enum-helper` package
- updated the banner

## v0.5.0 - 2022-06-14

- moved `LaravelEnum` to `Datomatic\EnumHelper\Traits\Laravel` namespace
- code refactor

## v0.4.0 - 2022-06-14

Renamed these methods:

- `namesArray()` => `namesByValue()`
- `valuesArray()` => `valuesByName()`

`descriptionsArray()` splitted into 2 methods `descriptionsByName()`, `descriptionsByValue()`

Renamed `EnumLaravelLocalization` trait to` LaravelEnum`

Added new `[method]AsSelect()` methods that return `[method]ByValue()` if is `BackedEnum`, `[method]ByName()` otherwise.

Added these exceptions:

- `NotBackedEnum`
- `EmptyCases`
- `UndefinedStaticMethod`

Added dynamic methods on LaravelEnum trait

## v0.3.1 - 2022-05-30

- Fixed README.md
- Added return type on InvalidUniqueId exception

## v0.3.0 - 2022-05-30

- Merge translations and descriptions
- Move UniqueId out of EnumHelper

## v0.2.0 - 2022-05-27

First release 🚀
