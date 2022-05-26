![Enum Helper-Dark](branding/dark.png#gh-dark-mode-only)![Enum Helper-Light](branding/light.png#gh-light-mode-only)
# Enum Helper
A simple and opinionated collections of PHP 8.1 enum helpers inspired by [archtechx/enums](https://github.com/archtechx/enums) and [BenSampo/laravel-enum](https://github.com/BenSampo/laravel-enum).

This package is framework agnostic, but has a translation functionality based on Laravel framework, but it can extend to use in other frameworks.

Each functionality has a Trait class, but you can use EnumHelper trait that include all Trait except for Descriptions and Translations. 

Functionalities summary:
- [Invokable Cases](#invokable-cases)  
    `Enum::pending() // enum case value`
- [From and FromName constructors](#from-fromName)  
    `Enum::from('PENDING'); BackedEnum::from('P'); `
- [Instances Equality (is, isNot, in, notIn)](#equality)  
    `$enum->is('PENDING'); $backedEnum->is('P'); $enum->is(Enum::PENDING);`  
    `$enum->in(['PENDING','ACCEPTED']); $backedEnum->in(['P','A']); $enum->in([Enum::PENDING]);`
- [Names list](#names)  
    `Enum::names() // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']`
- [Values list](#values)  
    `Enum::values() // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']`  
    `BackedEnum::values() // ['P', 'A', 'D', 'N']`
- UniqueId  
    `$enum->uniqueId() // Namespace\Status.PENDING`
- Descriptions  
    `Enum::descriptions() // ['Await decision','Recognized valid','No longer useful','No response']`
- Translations  
  `$enum->translate() // 'In attesa'`  
  `$enum->translations() // ['In attesa','Accettato','Rifiutato','Nessuna Risposta',]`

## Installation

PHP 8.1+ is required.

```sh
composer require datomatic/enum-helper
```

## Invokable Cases 

## From FromName

## Equality

## Names

## Values 

## UniqueId

## Descriptions 

## Translations 
