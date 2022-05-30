![Enum Helper-Dark](branding/dark.png#gh-dark-mode-only)![Enum Helper-Light](branding/light.png#gh-light-mode-only)
# Enum Helper
[![Latest Version on Packagist](https://img.shields.io/packagist/v/datomatic/enum-helper.svg?style=for-the-badge)](https://packagist.org/packages/datomatic/enum-helper)
[![Pest Tests number](https://img.shields.io/static/v1?label=%23tests&message=186&color=FF88FA&style=for-the-badge&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAMAAABF0y+mAAABiVBMVEUAAAD/iPv9yP3Xm+j/mP//wfVj67Je6bP/h/pVx6p6175d57WQycf+iPn/iPrsnezArd3+t/qpvNJd6LP/jPpu6rv/lPr/kPpc57T/rvtc57Np6rj3oPl37cL/tfn/wv9d6brX//L/g/rYn+n/gvrWm+di6LX+jPrskfGWzMpt6bln4bdd57Jk6LWSycj+vPquwNVo6rde6bP7nvvYnup91b/+vfv/lvtc57OqvNTFs9//t/td57L9t/r/iPpd6LPapej/ovp26bxy67v9lfld6LJr4Ljwsvb/xv3/jv39zv1t6buG5cTDreH5ivlc5rJy676V4cxb57D/y/h50MOy4OCUxcVa77X/iPpe6LP/jP+pu9L8t///tvuQycfArNxp6LzArd151r7/i/9n4bb/j/9e6rT/ifr7ifrskvLYnuhi87tg8blg7bf/vv//lP+wxNtj9b3/qv//oP/+ivz/l/r8ifryn/fvlPTfpPDeofDKtujHtOWX1NF/4seC3cR82sFu7cBo5LiMwPMrAAAAWHRSTlMA/Wv8FAIC/dME/Wj+3tEG/Pv798G1oHRjS0k1LBsWDgsJ/v36+fTy8ezn4+Lh29XNzMzLysLAwLSwr66opJqakY+Ni4J7end0bGlpY11XU048KicmIR8fizl+vwAAAVdJREFUKM9tz2VXAlEQgOFBBURpkE67u7u7E1YFYQl1SbvrlztDiLvss+fc/fCemXMvAEhhKqU759P1rLoxUDUyEh9fPH0z7ALiVrEY+SSNtxNS2upouYv7hOL191aKVsZHUTgbnQPQgDkq4ctHdoQmTWmW4WFzlVUDVpNKXf2fWpWbZIwUq/hcmjWGYnSa1pZZjEoomrEdVAisD7CX6GEb40rqTODxCj21OjDOvjRV8l2jhudBDchg/FUbDIZCITzwQyH6a9+2AMDbm9GfltFnxgAdtQWUgQJl4VQq37uPcSnsfYZzav6Ew18fQ4fUYPM7Qn4uSiIdyx5saJ6T+/3+5KSltshicwI2UpfAKE/aoARTvnn7KMYMdlAUyWRSyHN2JeU42HlCi4TszTHcmuj3iMVdP5JzoyAWNzi6T3ZGrMFCliK3BAqRSC/B2+6IxvYYNcO+2Npfv+yFi10LfBUAAAAASUVORK5CYII=)](https://github.com/datomatic/enum-helper/tree/main/tests)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/datomatic/enum-helper/run-tests?label=tests&color=5FE8B3&style=for-the-badge&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAMAAABF0y+mAAABiVBMVEUAAAD/iPv9yP3Xm+j/mP//wfVj67Je6bP/h/pVx6p6175d57WQycf+iPn/iPrsnezArd3+t/qpvNJd6LP/jPpu6rv/lPr/kPpc57T/rvtc57Np6rj3oPl37cL/tfn/wv9d6brX//L/g/rYn+n/gvrWm+di6LX+jPrskfGWzMpt6bln4bdd57Jk6LWSycj+vPquwNVo6rde6bP7nvvYnup91b/+vfv/lvtc57OqvNTFs9//t/td57L9t/r/iPpd6LPapej/ovp26bxy67v9lfld6LJr4Ljwsvb/xv3/jv39zv1t6buG5cTDreH5ivlc5rJy676V4cxb57D/y/h50MOy4OCUxcVa77X/iPpe6LP/jP+pu9L8t///tvuQycfArNxp6LzArd151r7/i/9n4bb/j/9e6rT/ifr7ifrskvLYnuhi87tg8blg7bf/vv//lP+wxNtj9b3/qv//oP/+ivz/l/r8ifryn/fvlPTfpPDeofDKtujHtOWX1NF/4seC3cR82sFu7cBo5LiMwPMrAAAAWHRSTlMA/Wv8FAIC/dME/Wj+3tEG/Pv798G1oHRjS0k1LBsWDgsJ/v36+fTy8ezn4+Lh29XNzMzLysLAwLSwr66opJqakY+Ni4J7end0bGlpY11XU048KicmIR8fizl+vwAAAVdJREFUKM9tz2VXAlEQgOFBBURpkE67u7u7E1YFYQl1SbvrlztDiLvss+fc/fCemXMvAEhhKqU759P1rLoxUDUyEh9fPH0z7ALiVrEY+SSNtxNS2upouYv7hOL191aKVsZHUTgbnQPQgDkq4ctHdoQmTWmW4WFzlVUDVpNKXf2fWpWbZIwUq/hcmjWGYnSa1pZZjEoomrEdVAisD7CX6GEb40rqTODxCj21OjDOvjRV8l2jhudBDchg/FUbDIZCITzwQyH6a9+2AMDbm9GfltFnxgAdtQWUgQJl4VQq37uPcSnsfYZzav6Ew18fQ4fUYPM7Qn4uSiIdyx5saJ6T+/3+5KSltshicwI2UpfAKE/aoARTvnn7KMYMdlAUyWRSyHN2JeU42HlCi4TszTHcmuj3iMVdP5JzoyAWNzi6T3ZGrMFCliK3BAqRSC/B2+6IxvYYNcO+2Npfv+yFi10LfBUAAAAASUVORK5CYII=)](https://github.com/datomatic/enum-helper/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/datomatic/enum-helper/Check%20&%20fix%20styling?label=code%20style&color=5FE8B3&style=for-the-badge)](https://github.com/datomatic/enum-helper/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/datomatic/enum-helper.svg?style=for-the-badge)](https://packagist.org/packages/datomatic/enum-helper)

A simple and opinionated collections of PHP 8.1 enum helpers inspired by [archtechx/enums](https://github.com/archtechx/enums) and [BenSampo/laravel-enum](https://github.com/BenSampo/laravel-enum).  
This package is framework agnostic, but has there is an optional localization implementation based on Laravel framework.

## Functionalities summary
- **Invokable cases**: get the value of enum "invoking" it statically
- **Construct enum by name or value**: `from()`, `tryFrom()`, `fromName()`, `tryFromName()` for all enums
- **Enums Equality**:  `is()`, `isNot()`, `in()`, `notIn()` methods
- **Names**: methods to have a list of case names (`names()`, `namesArray()`)
- **Values**: methods to have a list of case values (`values()`, `valuesArray()`)
- **Unique ID**: get an unique identifier from instance or instance from identifier (`uniqueId()`, `fromUniqueId()`)
- **Descriptions & Translations**: add description to enum with optional translation (`description()`,`descriptions()`,`descriptionsArray()`)

## Installation

PHP 8.1+ is required.

```sh
composer require datomatic/enum-helper
```

## Usage

You can use the traits you need, but for convenience, you can use only the `EnumHelper` trait that includes (`EnumInvokable`, `EnumFroms`, `EnumNames`, `EnumValues`, `EnumEquality`).  
`EnumDescription` and `EnumUniqueId` are separated from `EnumHelper` because they cover edge cases. 


The helper support both pure enum (e.g. `Status`, `StatusPascalCase`) and `BackedEnum` (e.g. `StatusInt`, `StatusString`).

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
- [Descriptions & Translations](#descriptions)



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

The helper is not included on the base `EnumHelper` trait and does not depend on it, so if you need it you must use `EnumUniqueId`.
```php
use Datomatic\EnumHelper\Traits\EnumUniqueId;

enum Status
{
    use EnumUniqueId;
    
    ...
```
#### uniqueId()
This method returns the enum unique identifier based on Namespace\ClassName.CASE_NAME.
You can use this identifier to save multiple types of enums in a database on a polymorphic column.
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



### Descriptions & Translations
This helper permits to have a description of each case of an enum. Work with both singular language and multilingual application. 
This is useful when you need descriptions to characterize the cases better or in a multilingual context. 

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

    public function description(?string $lang = null): string
    {
        return match ($this) {
            self::PENDING => 'Await decision',
            self::ACCEPTED => 'Recognized valid',
            self::DISCARDED => 'No longer useful',
            self::NO_RESPONSE => 'No response',
        };
    }
```
After the implementation of `description` method you can use it
```php
Status::PENDING->description(); // 'Await decision'
```


#### Localization
To translate the descriptions you can change the description method with your translation method.
If you are using Laravel you can use [`EnumLaravelLocalization` trait](#laravel) instead.
```php
public function description(?string $lang = null): string
    {
        // this is only an example of implementation... translate method not exist
        // if $lang is null you have to use the current locale
        return return translate('status.'$this->name, $lang);
        
        // or translate each case
        return match ($this) {
            self::PENDING => translate('Await decision'),
            self::ACCEPTED => translate('Recognized valid'),
            self::DISCARDED => translate('No longer useful'),
            self::NO_RESPONSE => translate('No response'),
        };
        
        //or use EnumUniqueId trait
        return translate($this->uniqueId(), $lang);
    }
```

After the implementation of `description` method you can use it
```php
$enum = Status::PENDING;
$enum->description(); // 'Await decision'
// forcing language
$enum->description('it'); // 🇮🇹 'In attesa'
```


#### Laravel
If you use Laravel framework and you need localization, you can use the `EnumLaravelLocalization` trait instead `EnumDescription`.
This trait extend `EnumDescription` and implement the `description()` method using Laravel Localization features.

```php
use Datomatic\EnumHelper\Traits\EnumLaravelLocalization;

enum StatusString
{
    use EnumLaravelLocalization;

    case PENDING = 'P';
```
Using this trait there is 2 way to manage translation strings.

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
     // or using the enum object name attribute
    StatusString::class => [
        StatusString::PENDING->name => 'In attesa',
        StatusString::ACCEPTED->name => 'Accettato',
    ...
```

##### Using Translation Strings As Keys
Language strings are stored as JSON files in the lang directory (e.g. `lang/it.json`).
```json
{
    "enums.Namespace\\StatusString.PENDING": "In attesa",
    ...
```
But if you want to use this way, you can simply use the `EnumDescription` trait and translate each case on `description` method.

```php
public function description(?string $lang = null): string
{
    return match ($this) {
        self::PENDING => __('Await decision'),
        self::ACCEPTED => __('Recognized valid'),
        self::DISCARDED => __('No longer useful'),
        self::NO_RESPONSE => __('No response'),
    };
```

#### descriptions()
This method returns a list of case descriptions of enum.
```php
StatusString::descriptions(); // ['Await decision','Recognized valid','No longer useful','No response']
// Subset
StatusString::descriptions([StatusString::ACCEPTED, StatusString::NO_RESPONSE]); // ['Recognized valid','No response']
// Forcing language
Status::descriptions(null, 'it'); // 🇮🇹 ['In attesa','Accettato','Rifiutato','Nessuna Risposta']
// Subset and language 
Status::descriptions([Status::NO_RESPONSE, Status::DISCARDED], 'it'); // 🇮🇹 ['Nessuna Risposta', 'Rifiutato']
```

#### descriptionsArray()
This method returns a associative array of [value => description] on `BackedEnum`, [name => description] on pure enum.
```php
StatusString::descriptionsArray(); // ['P' => 'Await decision', 'A' => 'Recognized valid',...
Status::descriptionsArray(); // ['PENDING' => 'Await decision', 'ACCEPTED' => 'Recognized valid',...
// Subset
StatusString::descriptionsArray([StatusString::DISCARDED, StatusString::ACCEPTED]); // ['D' => 'No longer useful', 'A' => 'Recognized valid']
Status::descriptionsArray([[Status::PENDING, Status::DISCARDED]); // ['PENDING' => 'Await decision', 'DISCARDED' => 'No longer useful']
// Forcing language
StatusString::descriptionsArray(null, 'it'); // 🇮🇹 ['P' => 'In attesa','A' => 'Accettato',...
// Subset and language 
Status::descriptionsArray([Status::DISCARDED, Status::NO_RESPONSE], 'it'); // 🇮🇹 ['DISCARDED' => 'Rifiutato','NO_RESPONSE' => 'Nessuna Risposta',...
```