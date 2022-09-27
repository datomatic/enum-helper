# Changelog

All notable changes to `enum-helper` will be documented in this file.

## v1.0.0 - 2022-09-09

- v 1.0 🚀 🎉
- Added Inspection methods (`isPure()`,`isBacked()`,`has()`, `doesntHave()`, `hasName()`, `doesntHaveName()`, `hasValue()`, `doesntHaveValue()`)
- Refactored readme examples and test classes name

## v0.7.2 - 2022-09-08

- permit enum equality to compare IntBackedEnum with numeric string

## v0.7.1 - 2022-07-05

- added support of null param on `in()` and `notIn()` methods

## v0.7.0 - 2022-07-02

After migrating several projects with my fellow @RobertoNegro and listening to different opinions we have decided to simplify the package.
From now on, I will consider a pure enum as a `StringBackedEnum` with names as values, so all `***AsSelect()` methods will be replaced by `***ByValue()` methods.

- removed all methods `***AsSelect()`
- added support on `***ByValue()` methods also for pure enum using name instead value
- removed `NotBackedEnum` exception

## v0.6.2 - 2022-06-28

- added `fromValue()` and `tryFromValue()` aliases
- refactored EnumFromTest.php

## v0.6.1 - 2022-06-20

- set public dynamic methods

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
