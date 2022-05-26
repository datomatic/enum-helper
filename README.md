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

The helper support both pure (Status,StatusPascalCase) and backed enum (StatusInt,StatusString).

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
This helper lets you get the value of a backed enum, or the name of a pure enum, by "invoking" it both statically (`Status::PENDING()`), and as an instance (`$status()`).  
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

#### IDE completion
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

### Equality

### Names

### Values 

### UniqueId

### Descriptions 

### Translations 
