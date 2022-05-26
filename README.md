![Enum Helper-Dark](branding/dark.png#gh-dark-mode-only)![Enum Helper-Light](branding/light.png#gh-light-mode-only)
# Enum Helper
A simple and opinionated collections of PHP 8.1 enum helpers inspired by [archtechx/enums](https://github.com/archtechx/enums) and [BenSampo/laravel-enum](https://github.com/BenSampo/laravel-enum).

This package is framework agnostic, but has a translation functionality based on Laravel framework, but it can extend to use in other frameworks.

Each functionality has a Trait class, but you can use EnumHelper trait that include all Trait except for Descriptions and Translations. 

Functionalities:
- Invokable Cases
- From and From Name constructors
- Instances Equality (is, in)
- Names list
- Values list
- UniqueId
- Descriptions
- Translations

## Installation

PHP 8.1+ is required.

```sh
composer require datomatic/enum-helper
```