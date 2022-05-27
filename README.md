![Enum Helper-Dark](branding/dark.png#gh-dark-mode-only)![Enum Helper-Light](branding/light.png#gh-light-mode-only)
# Enum Helper
[![Latest Version on Packagist](https://img.shields.io/packagist/v/datomatic/enum-helper.svg?style=flat-square)](https://packagist.org/packages/datomatic/enum-helper)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/datomatic/enum-helper/run-tests?label=tests)](https://github.com/datomatic/enum-helper/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/datomatic/enum-helper/Check%20&%20fix%20styling?label=code%20style)](https://github.com/datomatic/enum-helper/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/datomatic/enum-helper.svg?style=flat-square)](https://packagist.org/packages/datomatic/enum-helper)

A simple and opinionated collections of PHP 8.1 enum helpers inspired by [archtechx/enums](https://github.com/archtechx/enums) and [BenSampo/laravel-enum](https://github.com/BenSampo/laravel-enum).  
This package is framework agnostic, but has a translation functionality that must be extended to work. Actually there is an implementation based on Laravel framework.

## Functionalities summary
- **Invokable cases**: get the value of enum "invoking" it statically
- **Construct enum by name or value**: `from()`, `tryFrom()`, `fromName()`, `tryFromName()` for all enums
- **Enums Equality**:  `is()`, `isNot()`, `in()`, `notIn()` methods
- **Names**: methods to have a list of case names (`names()`, `namesArray()`)
- **Values**: methods to have a list of case values (`values()`, `valuesArray()`)
- **Unique ID**: get an unique identifier from instance or instance from identifier (`uniqueId()`, `fromUniqueId()`)
- **Descriptions**: add description method and relative utilities to an enum (`description()`,`descriptions()`,`descriptionsArray()`)
- **Translations**: use enums on a multilanguage project (`translate()`,`translations()`,`translationsArray()`)

## Installation

PHP 8.1+ is required.

```sh
composer require datomatic/enum-helper
```

## Usage

You can use the traits you need, but for convenience, you can use only the `EnumHelper` trait that includes (`EnumInvokable`, `EnumFroms`, `EnumNames`, `EnumValues`, `EnumEquality`, and `EnumUniqueId`).  
`EnumDescription` and `EnumBaseTranslations` are separated from `EnumHelper` because cover edge cases. 


The helper support both pure enum (on ex. `Status`, `StatusPascalCase`) and `BackedEnum` (on ex. `StatusInt`, `StatusString`).

In all examples we'll use the classes described below:

```php
use Datomatic\EnumHelper\EnumHelper;

enum Status
{
    use EnumHelper;
    
    case PENDING;
    case ACCEPTED;
    case DISCARDED;
    case NO_RESPONSE;
}

enum StatusString: string
{
    use EnumHelper;
    
    case PENDING = 'P';
    case ACCEPTED = 'A';
    case DISCARDED = 'D';
    case NO_RESPONSE = 'N';
}

enum StatusInt: int
{
    use EnumHelper;
    
    case PENDING = 0;
    case ACCEPTED = 1;
    case DISCARDED = 2;
    case NO_RESPONSE = 3;
}

enum StatusPascalCase
{
    use EnumHelper;
    
    case Pending;
    case Accepted;
    case Discarded;
    case NoResponse;
}
```
The package works with cases written in UPPER_CASE, snake_case and PascalCase.

### Jump To
- [Invokable Cases](#invokable-cases)
- [Froms](#from-fromName)
- [Enums Equality](#equality)
- [Names](#names)
- [Values](#values)
- [Unique ID](#uniqueid)
- [Descriptions](#descriptions)
- [Translations](#translations)



### Invokable Cases 
This helper lets you get the value of a `BackedEnum`, or the name of a pure enum, by "invoking" it both statically (`Status::pending()`), and as an instance (`$status()`).  
A good approach is to call methods in camelCase mode but you can invoke the enum in all cases ::STATICALLY(), ::statically() or ::Statically().
```php
StatusInt::PENDING // Status enum instance
StatusInt::pending(); // 0
```

That way permits you to use enum invoke into an array keys definition:
```php
'statuses' => [
    Status::pending() => 'some configuration',
...
```
or in database interactions ` $db_field_definition->default(Status::PENDING())`
or invoke instances to get the primitive value
```php
public function updateStatus(int $status): void;

$task->updateStatus(StatusInt::pending());
```

#### Examples use static calls to get the primitive value
```php
// pure enum
Status::noResponse(); // 'NO_RESPONSE'
Status::NO_RESPONSE(); // 'NO_RESPONSE'
Status::NoResponse(); // 'NO_RESPONSE'

// pure eum with PascalCase
StatusPascalCase::noResponse(); // 'NoResponse'
StatusPascalCase::NO_RESPONSE(); // 'NoResponse'
StatusPascalCase::NoResponse(); // 'NoResponse'

// backed int eum
StatusInt::pending(); // 0

// backed int eum
StatusString::pending(); // 'P'

```

#### IDE code completion
To have a code completion you can get autosuggestions while typing the enum case and then add () or you can add phpDoc @method tags to the enum class to define all invokable cases like this:
```php
/**
 * @method static string pending()
 * @method static string accepted()
 * @method static string discarded()
 * @method static string noResponse()
 */
enum Status
...
```



### From FromName
This helper adds `from()` and `tryFrom()` to pure enums, and adds `fromName()` and `tryFromName()` to all enums.
#### Important Notes:
- `BackedEnum` instances already implement their own `from()` and `tryFrom()` methods, which will not be overridden by this trait.
- Pure enums only have named cases and not values, so the `from()` and `tryFrom()` methods are functionally equivalent to `fromName()` and `tryFromName()`

#### `from()`
```php
Status::from('PENDING'); // Status::PENDING
StatusPascalCase::from('Pending'); // StatusPascalCase::Pending
Status::from('MISSING'); // ValueError Exception
```

#### `tryFrom()`
```php
Status::tryFrom('PENDING'); // Status::PENDING
Status::tryFrom('MISSING'); // null
```

#### `fromName()`
```php
Status::fromName('PENDING'); // Status::PENDING
Status::fromName('MISSING'); // ValueError Exception
StatusString::fromName('PENDING'); // StatusString::PENDING
StatusString::fromName('MISSING'); // ValueError Exception
```

#### `tryFromName()`
```php
Status::tryFromName('PENDING'); // Status::PENDING
Status::tryFromName('MISSING'); // null
StatusString::tryFromName('PENDING'); // StatusString::PENDING
StatusString::tryFromName('MISSING'); // null
```

### Equality
This helper permits to compare an enum instance (`is()`,`isNot()`) and search if it is present inside an array (`in()`,`notIn()`).

#### `is()` and `isNot()`

`is()` method permit checking the equality of an instance against an enum instance, a case name, or a case value.  
For convenience, there is also an `isNot()` method which is the exact reverse of the `is()` method.
```php
$enum = Status::PENDING;
$enum->is(Status::PENDING); // true
Status::PENDING->is(Status::ACCEPTED); // false
Status::PENDING->is('PENDING'); // true
Status::PENDING->is('ACCEPTED'); // false
Status::PENDING->isNot('ACCEPTED'); // true


$backedEnum = StatusInt::PENDING;
$backedEnum->is(StatusInt::PENDING); // true
StatusInt::PENDING->is(StatusInt::ACCEPTED); // false
StatusInt::PENDING->is(0); // true
StatusInt::PENDING->is('PENDING'); // true
StatusString::PENDING->is('P'); // true
StatusString::PENDING->isNot('P'); // false
```

#### `in()` and `notIn()`
`in()` method permit to see if an instance matches on an array of instances, names or values.
For convenience, there is also a `notIn()` method which is the exact reverse of the `i()` method.
```php
$enum = Status::PENDING;
$enum->in([Status::PENDING,Status::ACCEPTED]); // true
Status::PENDING->in([Status::DISCARDED, Status::ACCEPTED]); // false
Status::PENDING->in(['PENDING', 'ACCEPTED']); // true
Status::PENDING->in(['ACCEPTED', 'DISCARDED']); // false
Status::PENDING->notIn(['ACCEPTED']); // true

$backedEnum = StatusInt::PENDING;
$backedEnum->in([StatusInt::PENDING, StatusInt::ACCEPTED]); // true
StatusInt::PENDING->in([StatusInt::ACCEPTED])// false
StatusInt::PENDING->in([0, 1, 2]); // true
StatusInt::PENDING->in([2, 3]); // false
StatusInt::PENDING->in(['PENDING', 'ACCEPTED']); // true
StatusInt::PENDING->in(['DISCARDED', 'ACCEPTED']); // false
StatusString::PENDING->in(['P', 'D']); // true
StatusString::PENDING->notIn(['A','D']); // true
```



### Names
This helper offer `names` and `namesArray` methods.

#### `names()`
This method returns a list of case names in the enum.  
```php
Status::names(); // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
StatusPascalCase::names(); // ['Pending', 'Accepted', 'Discarded', 'NoResponse']
StatusString::names(); // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
// Subset
Status::names([Status::NO_RESPONSE, Status::DISCARDED]); // ['NO_RESPONSE', 'DISCARDED']
StatusPascalCase::names([StatusPascalCase::Accepted, StatusPascalCase::Discarded]); // ['Accepted', 'Discarded']
```

#### `namesArray()`

This method returns a associative array of [value => name] on `BackedEnum`, names array otherwise.  
```php
Status::namesArray(); // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
StatusString::namesArray(); // [ 'P'=>'PENDING', 'A'=>'ACCEPTED', 'D'=>'DISCARDED'...
StatusInt::namesArray(); // [ 0=>'PENDING', 1=>'ACCEPTED', 2=>'DISCARDED'...
// Subset
StatusInt::namesArray([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]); // [ 3=>'NO_RESPONSE', 2=>'DISCARDED']
```



### Values 
This helper offer `values` and `valuesArray` methods.

#### `values()`
This method returns a list of case values for `BackedEnum` or a list of case names for pure enums.
```php
StatusString::values(); // ['P', 'A', 'D', 'N']
StatusInt::values(); // [0, 1, 2, 3]
// Subset
StatusString::values([StatusString::NO_RESPONSE, StatusString::DISCARDED]); // ['N', 'D']
StatusInt::values([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]); // [3, 2]
```
#### `valuesArray()`
This method returns a associative array of [case name => case value] on `BackedEnum`, names array otherwise
```php
StatusString::valuesArray(); // ['PENDING' => 'P','ACCEPTED' => 'A','DISCARDED' => 'D','NO_RESPONSE' => 'N']
StatusInt::valuesArray(); // ['PENDING' => 0,'ACCEPTED' => 1,'DISCARDED' => 2,'NO_RESPONSE' => 3]
// Subset
StatusString::valuesArray([StatusString::NO_RESPONSE, StatusString::DISCARDED]); // ['NO_RESPONSE' => 'N', 'DISCARDED' => 'D']
StatusInt::valuesArray([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]); // ['NO_RESPONSE' => 3, 'DISCARDED' => 2]
```



### UniqueId
This helper permits to get an unique identifier from enum or an enum instance from identifier.

#### uniqueId()
This method returns the enum unique identifier based on Namespace\ClassName.CASE_NAME.
You can use this identifier to make a custom translation without translation trait like `translate($enum->uniqueId())`
or you can save multiple types of enums in a database on a polymorphic column.
```php
Status::PENDING->uniqueId(); // Namespace\Status.PENDING
$enum = StatusString::NO_RESPONSE;
$enum->uniqueId(); // Namespace\StatusString.NO_RESPONSE
```
#### fromUniqueId()
This method returns an enum instance from unique identifier.
```php
Status::fromUniqueId('Namespace\Status.PENDING'); // Status::PENDING
StatusInt::fromUniqueId('Namespace\StatusInt.PENDING'); // StatusInt::PENDING
StatusInt::fromUniqueId('NOT.valid.uniqueId'); // throw InvalidUniqueId Exception
StatusInt::fromUniqueId('Wrong\Namespace\StatusInt.PENDING'); // throw InvalidUniqueId Exception
StatusInt::fromUniqueId('Namespace\StatusInt.MISSING'); // throw InvalidUniqueId Exception
```

#### Global getEnumFromUniqueId() helper
The method `fromUniqueId()` has little possibility of use because it's related to only an enum class.
A better approach is to create a global helper to instantiate any enum from uniqueId like this:
```php
use Datomatic\EnumHelper\Exceptions\InvalidUniqueId;

public function getEnumFromUniqueId(string $uniqueId): object
{
    if (
        !strpos($uniqueId, '.')
        || substr_count($uniqueId, '.') !== 1
    ) {
        throw InvalidUniqueId::uniqueIdFormatIsInvalid($uniqueId);
    }

    list($enumClass, $case) = explode('.', $uniqueId);

    $cases = array_filter($enumClass::cases(), fn($c) => $c->name === $case);

    if (empty($cases)) {
        throw InvalidUniqueId::caseNotPresent($case);
    }
    
    return array_values($cases)[0];
}
```



### Descriptions 
This helper permits to have a description of each case of an enum.  
This is useful when you need descriptions to characterize the cases better or have the code base in English, but the application language is different. If you have a multilanguage application consider using [translations](#translations) instead. 

The helper is not included on the base `EnumHelper` trait and does not depend on it, so if you need it you must use `EnumDescription` and implement the abstract `description()` method to define the descriptions.
You can use it on both pure enums and `BackedEnum`.
```php
use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Traits\EnumDescription;

enum StatusString: string
{
    use EnumHelper;
    use EnumDescription;
    
    case PENDING = 'P';
    case ACCEPTED = 'A';
    case DISCARDED = 'D';
    case NO_RESPONSE = 'N';

    public function description(): string
    {
        return match ($this) {
            self::PENDING => 'Await decision',
            self::ACCEPTED => 'Recognized valid',
            self::DISCARDED => 'No longer useful',
            self::NO_RESPONSE => 'No response',
        };
    }
```

#### descriptions()
This method returns a list of case descriptions of enum.
```php
StatusString::descriptions(); // ['Await decision','Recognized valid','No longer useful','No response']
// Subset
StatusString::descriptions([StatusString::ACCEPTED, StatusString::NO_RESPONSE]); // ['Recognized valid','No response']
```

#### descriptionsArray()
This method returns a associative array of [value => description] on `BackedEnum`, [name => description] on pure enum.
```php
StatusString::descriptionsArray(); // ['P' => 'Await decision', 'A' => 'Recognized valid',...
Status::descriptionsArray(); // ['PENDING' => 'Await decision', 'ACCEPTED' => 'Recognized valid',...
// Subset
StatusString::descriptionsArray([StatusString::DISCARDED, StatusString::ACCEPTED]); // ['D' => 'No longer useful', 'A' => 'Recognized valid']
Status::descriptionsArray([[Status::PENDING, Status::DISCARDED]); // ['PENDING' => 'Await decision', 'DISCARDED' => 'No longer useful']
```


### Translations 
This helper permits to use of enums in a multilanguage context.  

The helper is not included on the base `EnumHelper` trait and does not depend on it, so if you need it you must use `EnumBaseTranslation` and implement the abstract `translate()` method to define the translation.  
If you are using Laravel you can use [`EnumLaravelTranslation` trait](#laravel) instead.  

You can use it on both pure enums and `BackedEnum`.
```php
use Datomatic\EnumHelper\Traits\EnumBaseTranslation;

trait EnumTranslation
{
    use EnumBaseTranslation;

    public function translate(string $lang = null): string
    {
        // this is only an example of implementation... trans method not exist
        // if $lang is null you have to use the current locale otherwise, you must force the language passed
        return trans('status.'$this->name, $lang);
        // or if you use EnumHelper or EnumUniqueId trait
        return trans($this->uniqueId(), $lang);
    }
}
```
```php
use Datomatic\EnumHelper\EnumHelper;

enum Status
{
    use EnumHelper;
    use EnumTranslation;
    
    case PENDING;
    ...    
```

After the implementation of translate method you can use it
```php
$enum = Status::PENDING;
$enum->translate(); // 🇮🇹 'In attesa'
// forcing language
$enum->translate('en'); // 🇬🇧 'Await decision'
```

#### Laravel
If you use Laravel you can use the `EnumLaravelTranslation` trait instead `EnumBaseTranslation`.
This trait extend `EnumBaseTranslation` and implement the `translate()` method with Laravel Localization features.  
```php
use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Traits\EnumLaravelTranslation;

enum StatusString
{
    use EnumHelper;
    use EnumLaravelTranslation;
    
    case PENDING = 'P';
    ...
```

There is 2 way to manage translation strings.

##### Using Short Keys
Language strings may be stored in `enums.php` files within the `lang` directory. Within this directory, there may be subdirectories for each language supported by the application.
```
/lang
    /en
        enums.php
    /it
        enums.php
```
All language files return an array of keyed strings. The array has 2 levels: the first level has as a key the complete class name of the enum, and the second has as a key the name of the enum case.
```php
// /lang/it/enums.php

return [
    Status::class => [
        'PENDING' => 'In attesa',
        'ACCEPTED' => 'Accettato',
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ],
    StatusString::class => [
        'PENDING' => 'In attesa',
    ...
```
##### Using Translation Strings As Keys
Language strings are stored as JSON files in the lang directory (ex. `lang/it.json`).
```json
{
    "enums.Namespace\\StatusString.PENDING": "In attesa",
    "enums.Namespace\\StatusString.ACCEPTED": "In attesa",
    ...
    "enums.Namespace\\Status.PENDING": "In attesa",
    ...
```

#### `translations()`
This method returns a list of case translation of enum.
```php
Status::translations(); // 🇮🇹 ['In attesa','Accettato','Rifiutato','Nessuna Risposta']
// forcing language
Status::translations('en'); // 🇬🇧 ['Await decision','Recognized valid','No longer useful','No response']
// Subset
Status::translations(null, [Status::NO_RESPONSE, Status::DISCARDED]); // 🇮🇹 ['In attesa','Accettato','Rifiutato','Nessuna Risposta']
```

#### `translationsArray()`
This method returns a associative array of [value => translation] on `BackedEnum`, [name => translation] on pure enum.
```php
Status::translationsArray(); // 🇬🇧 ['PENDING' => 'Await decision','ACCEPTED' => 'Recognized valid',...
// forcing language
StatusString::translationsArray('it'); // 🇮🇹 ['P' => 'In attesa','A' => 'Accettato',...
// Subset
Status::translationsArray('it', [Status::DISCARDED, Status::NO_RESPONSE]); // 🇮🇹 ['DISCARDED' => 'Rifiutato','NO_RESPONSE' => 'Nessuna Risposta',...
```
