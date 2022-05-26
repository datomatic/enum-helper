![Enum Helper-Dark](branding/dark.png#gh-dark-mode-only)![Enum Helper-Light](branding/light.png#gh-light-mode-only)
# Enum Helper
A simple and opinionated collections of PHP 8.1 enum helpers inspired by [archtechx/enums](https://github.com/archtechx/enums) and [BenSampo/laravel-enum](https://github.com/BenSampo/laravel-enum).  
This package is framework agnostic, but has a translation functionality based on Laravel framework, but it can be extended with other frameworks.

Each functionality has a trait, but you can use EnumHelper trait that includes all traits except for Descriptions and Translations. 

Functionalities summary:
- [INVOKABLE CASES](#invokable-cases)  
    `Enum::pending() // enum case value`
- [FROM and FROM NAME constructors](#from-fromName)  
    `Enum::from('PENDING'); BackedEnum::from('P'); `
- [INSTANCES EQUALITY (is, isNot, in, notIn)](#equality)  
    `$enum->is('PENDING'); $backedEnum->is('P'); $enum->is(Enum::PENDING);`  
    `$enum->in(['PENDING','ACCEPTED']); $backedEnum->in(['P','A']); $enum->in([Enum::PENDING]);`
- [NAMES list](#names)  
    `Enum::names() // ['PENDING', 'ACCEPTED', 'DISCARDED']`
- [VALUES list](#values)  
    `Enum::values() // ['PENDING', 'ACCEPTED', 'DISCARDED']`  
    `BackedEnum::values() // ['P', 'A', 'D']`
- [UNIQUE ID](#uniqueid)  
    `$enum->uniqueId() // 'Namespace\Class.PENDING'`
- [DESCRIPTIONS](#descriptions)  
    `Enum::descriptions() // ['Await decision','Recognized valid','No longer useful']`
- [TRANSLATIONS](#translations)  #
  `$enum->translate() // 'In attesa'`  
  `$enum->translations() // ['In attesa','Accettato','Rifiutato']`

## Installation

PHP 8.1+ is required.

```sh
composer require datomatic/enum-helper
```

## Usage

You can use the traits do you need, but for convenience you can use only EnumHelper trait that includes (EnumInvokable, EnumFroms, EnumNames, EnumValues, EnumEquality, EnumUniqueId).

The helper support both pure (Status,StatusPascalCase) and `BackedEnum` (StatusInt,StatusString).

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
The package work with cases writed in UPPER_CASE, snake_case and PascalCase.

### Invokable Cases 
This helper lets you get the value of a `BackedEnum`, or the name of a pure enum, by "invoking" it both statically (`Status::PENDING()`), and as an instance (`$status()`).  
A good approach is to call methods in camelCase mode but you can invoke the enum ::STATICALLY(), ::statically() or ::Statically().
```php
StatusInt::PENDING // Status enum instance
StatusInt::pending() // 0
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

#### Examples Use static calls to get the primitive value
```php
// pure enum
Status::noResponse() // 'NO_RESPONSE'
Status::NO_RESPONSE() // 'NO_RESPONSE'
Status::NoResponse() // 'NO_RESPONSE'

// pure eum with PascalCase
StatusPascalCase::noResponse() // 'NoResponse'
StatusPascalCase::NO_RESPONSE() // 'NoResponse'
StatusPascalCase::NoResponse() // 'NoResponse'

// backed int eum
StatusInt::pending() // 0

// backed int eum
StatusString::pending() // 'P'

```

#### IDE code completion
To have a code completion you can get autosuggestions while typing the enum case and then add () or you can add phpDoc @method tag to the enum class to define all invokable cases like this:
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
Status::from('PENDING') // Status::PENDING
StatusPascalCase::from('Pending') // StatusPascalCase::Pending
Status::from('MISSING') // ValueError Exception
```

#### `tryFrom()`
```php
Status::tryFrom('PENDING') // Status::PENDING
Status::tryFrom('MISSING') // null
```

#### `fromName()`
```php
Status::fromName('PENDING') // Status::PENDING
Status::fromName('MISSING') // ValueError Exception
StatusString::fromName('PENDING') // StatusString::PENDING
StatusString::fromName('MISSING') // ValueError Exception
```

#### `tryfromName()`
```php
Status::tryfromName('PENDING') // Status::PENDING
Status::tryfromName('MISSING') // null
StatusString::tryfromName('PENDING') // StatusString::PENDING
StatusString::tryfromName('MISSING') // null
```

### Equality

### Names
This helper offer `names` and `namesArray` methods.

#### `names()`
This method returns a list of case names in the enum.  
```php
Status::names() // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
StatusPascalCase::names() // ['Pending', 'Accepted', 'Discarded', 'NoResponse']
StatusString::names() // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
```
You can also pass an array of enums to filter the results... useful when you need a subset:
```php
Status::names([Status::NO_RESPONSE, Status::DISCARDED]) // ['NO_RESPONSE', 'DISCARDED']
StatusPascalCase::names([StatusPascalCase::Accepted, StatusPascalCase::Discarded]) // ['Accepted', 'Discarded']
```

#### `namesArray()`

This method returns a associative array of [value => name] on `BackedEnum`, names array otherwise.  
```php
Status::namesArray() // ['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']
StatusString::namesArray() // [ 'P'=>'PENDING', 'A'=>'ACCEPTED', 'D'=>'DISCARDED'...
StatusInt::namesArray() // [ 0=>'PENDING', 1=>'ACCEPTED', 2=>'DISCARDED'...
```
You can also pass an array of enums to have a subset
```php
StatusInt::namesArray([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]) // [ 3=>'NO_RESPONSE', 2=>'DISCARDED']
```

### Values 
This helper offer `values` and `valuesArray` methods.

#### `values()`
This method returns a list of case values for `BackedEnum` or a list of case names for pure enums.
```php
StatusString::values() // ['P', 'A', 'D', 'N']
StatusInt::values() // [0, 1, 2, 3]
//subset
StatusString::values([StatusString::NO_RESPONSE, StatusString::DISCARDED]) // ['N', 'D']
StatusInt::values([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]) // [3, 2]
```
#### `valuesArray()`
This method returns a associative array of [case name => case value] on `BackedEnum`, names array otherwise
```php
StatusString::valuesArray() // ['PENDING' => 'P','ACCEPTED' => 'A','DISCARDED' => 'D','NO_RESPONSE' => 'N']
StatusInt::valuesArray() // ['PENDING' => 0,'ACCEPTED' => 1,'DISCARDED' => 2,'NO_RESPONSE' => 3]
//subset
StatusString::valuesArray([StatusString::NO_RESPONSE, StatusString::DISCARDED]) // ['NO_RESPONSE' => 'N', 'DISCARDED' => 'D']
StatusInt::valuesArray([StatusInt::NO_RESPONSE, StatusInt::DISCARDED]) // ['NO_RESPONSE' => 3, 'DISCARDED' => 2]
```

### UniqueId

### Descriptions 

### Translations 
