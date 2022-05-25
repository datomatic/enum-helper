<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusInt;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

// Invokable

it('can be used as a static method UPPERCASE, camelCase, PascalCase with pure enums to get value', function () {
    expect(Status::pending())->toBe('PENDING');
    expect(Status::PENDING())->toBe('PENDING');
    expect(Status::Pending())->toBe('PENDING');
    expect(Status::noResponse())->toBe('NO_RESPONSE');
    expect(Status::NO_RESPONSE())->toBe('NO_RESPONSE');
    expect(Status::NoResponse())->toBe('NO_RESPONSE');
    expect(StatusPascalCase::pending())->toBe('Pending');
    expect(StatusPascalCase::PENDING())->toBe('Pending');
    expect(StatusPascalCase::Pending())->toBe('Pending');
    expect(StatusPascalCase::noResponse())->toBe('NoResponse');
    expect(StatusPascalCase::NO_RESPONSE())->toBe('NoResponse');
    expect(StatusPascalCase::NoResponse())->toBe('NoResponse');
});

it('can be used as a static method UPPERCASE, camelCase, PascalCase with backed enums to get value', function () {
    expect(StatusInt::pending())->toBe(0);
    expect(StatusInt::PENDING())->toBe(0);
    expect(StatusInt::Pending())->toBe(0);
    expect(StatusInt::noResponse())->toBe(3);
    expect(StatusInt::NO_RESPONSE())->toBe(3);
    expect(StatusInt::NoResponse())->toBe(3);

    expect(StatusString::pending())->toBe('P');
    expect(StatusString::PENDING())->toBe('P');
    expect(StatusString::Pending())->toBe('P');
    expect(StatusString::noResponse())->toBe('N');
    expect(StatusString::NO_RESPONSE())->toBe('N');
    expect(StatusString::NoResponse())->toBe('N');
});

it('can be invoked as an instance as a pure enum', function () {
    $status = Status::PENDING;

    expect($status())->toBe('PENDING');
});

it('can be invoked as an instance as a backed enum', function () {
    $status = StatusInt::PENDING;

    expect($status())->toBe(0);
    expect($status())->toBe($status->value);
});

it('throws an error when a nonexistent case is being used for pure enums', function () {
    Status::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\Status::INVALID');

it('throws an error when a nonexistent case is being used for backed enums', function () {
    StatusString::INVALID();
})->throws(UndefinedCase::class, 'Undefined constant Datomatic\EnumHelper\Tests\Support\Enums\StatusString::INVALID');

// Arrays methods
it('can return an array of case values from a pure enum')
    ->expect(Status::values())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an array of case values from a pure enum with Pascal case')
    ->expect(StatusPascalCase::values())
    ->toBe(['Pending', 'Accepted', 'Discarded', 'NoResponse']);

it('can return an array of case values from a backed string enum')
    ->expect(StatusString::values())
    ->toBe(['P', 'A', 'D', 'N']);

it('can return an array of case values from a backed int enum')
    ->expect(StatusInt::values())
    ->toBe([0, 1, 2, 3]);

it('can return an array of case names from a pure enum')
    ->expect(Status::names())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an array of case names from a pure enum with Pascal case')
    ->expect(StatusPascalCase::names())
    ->toBe(['Pending', 'Accepted', 'Discarded', 'NoResponse']);

it('can return an array of case names from a backed string enum')
    ->expect(StatusString::names())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an array of case names from a backed int enum')
    ->expect(StatusInt::names())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an array names of namesArray from namesArray method in a pure enum')
    ->expect(Status::namesArray())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an array names of namesArray from valuesArray method in a pure enum')
    ->expect(Status::valuesArray())
    ->toBe(['PENDING', 'ACCEPTED', 'DISCARDED', 'NO_RESPONSE']);

it('can return an associative array value => name of namesArray from a backed int enum')
    ->expect(StatusInt::namesArray())
    ->toBe([
        0 => 'PENDING',
        1 => 'ACCEPTED',
        2 => 'DISCARDED',
        3 => 'NO_RESPONSE',
    ]);

it('can return an associative array value => name of namesArray from a backed string enum')
    ->expect(StatusString::namesArray())
    ->toBe([
        'P' => 'PENDING',
        'A' => 'ACCEPTED',
        'D' => 'DISCARDED',
        'N' => 'NO_RESPONSE',
    ]);

it('can return an associative array name => value of namesArray from a backed int enum')
    ->expect(StatusInt::valuesArray())
    ->toBe([
        'PENDING' => 0,
        'ACCEPTED' => 1,
        'DISCARDED' => 2,
        'NO_RESPONSE' => 3,
    ]);

it('can return an associative array name => value of namesArray from a backed string enum')
    ->expect(StatusString::valuesArray())
    ->toBe([
        'PENDING' => 'P',
        'ACCEPTED' => 'A',
        'DISCARDED' => 'D',
        'NO_RESPONSE' => 'N',
    ]);

// from and fromName methods
it('does work with from and fromName function', function ($enum, $expectedEnum) {
    expect($enum)->toBe($expectedEnum);
})->with([
    'Int Backed Enum' => [StatusInt::from(0), StatusInt::PENDING],
    'String Backed Enum' => [StatusString::from('P'), StatusString::PENDING],
    'Int Backed Enum from name' => [StatusInt::fromName('PENDING'), StatusInt::PENDING],
    'String Backed Enum from name' => [StatusString::fromName('PENDING'), StatusString::PENDING],
]);

it('does throw exception with wrong from value on BackedEnum int', function () {
    StatusInt::from(10);
})->throws(ValueError::class, '10 is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong from value on BackedEnum string', function () {
    StatusString::from('10');
})->throws(ValueError::class, '"10" is not a valid backing value for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('does throw exception with wrong fromName value on BackedEnum int', function () {
    StatusInt::fromName('PENDINGA');
})->throws(ValueError::class, '"PENDINGA" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusInt"');

it('does throw exception with wrong fromName value on BackedEnum string', function () {
    StatusString::fromName('PENDINGA');
})->throws(ValueError::class, '"PENDINGA" is not a valid name for enum "Datomatic\EnumHelper\Tests\Support\Enums\StatusString"');

it('can select a case by name with from() for pure enums', function () {
    expect(Status::from('PENDING'))->toBe(Status::PENDING);
});

it('can returns null when selecting a non-existent case by name with tryFrom() for pure enums')
    ->expect(Status::tryFrom('PENDINGA'))
    ->toBe(null)
    ->not->toThrow(ValueError::class);

it('doesn\'t throw exception with wrong from value on BackedEnum int', function () {
    expect(StatusInt::tryFrom(10))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from value on BackedEnum string', function () {
    expect(StatusString::tryFrom('10'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('doesn\'t throw exception with wrong from name on BackedEnum string', function () {
    expect(StatusString::tryFromName('PENDINGA'))->toBe(null)
        ->not->toThrow(ValueError::class);
});

it('can select a case by name with tryFromName() for backed enums')
    ->expect(StatusString::tryFromName('PENDING'))
    ->toBe(StatusString::PENDING);

it('can select a case by name with tryFromName() for pure enums')
    ->expect(StatusPascalCase::tryFromName('Pending'))
    ->toBe(StatusPascalCase::Pending);

// is, isNot, in, notIn
it('can compare enum using is method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->is($value))->toBe($result);
})->with([
    [Status::PENDING, Status::PENDING, true],
    [Status::PENDING, Status::ACCEPTED, false],
    [Status::PENDING, 'PENDING', true],
    [Status::PENDING, 'ACCEPTED', false],
    [Status::PENDING, 'P', false],
    [StatusInt::PENDING, StatusInt::PENDING, true],
    [StatusInt::PENDING, StatusInt::ACCEPTED, false],
    [StatusInt::PENDING, 0, true],
    [StatusInt::PENDING, 1, false],
    [StatusInt::PENDING, 'PENDING', false],
    [StatusString::PENDING, 'P', true],
    [StatusString::PENDING, 'A', false],
    [StatusString::PENDING, StatusString::PENDING, true],
    [StatusString::PENDING, StatusString::ACCEPTED, false],
    [StatusString::PENDING, 'PENDING', false],
]);

it('can compare enum using isNot method with enum, name and values', function ($enum, $value, $result) {
    expect($enum->isNot($value))->toBe($result);
})->with([
    [Status::PENDING, Status::PENDING, false],
    [Status::PENDING, Status::ACCEPTED, true],
    [Status::PENDING, 'PENDING', false],
    [Status::PENDING, 'ACCEPTED', true],
    [Status::PENDING, 'P', true],
    [Status::PENDING, Status::ACCEPTED, true],
    [StatusInt::PENDING, StatusInt::PENDING, false],
    [StatusInt::PENDING, 0, false],
    [StatusInt::PENDING, 1, true],
    [StatusInt::PENDING, 'PENDING', true],
    [StatusString::PENDING, 'P', false],
    [StatusString::PENDING, 'A', true],
    [StatusString::PENDING, StatusString::PENDING, false],
    [StatusString::PENDING, StatusString::ACCEPTED, true],
    [StatusString::PENDING, 'PENDING', true],
]);

it('can compare enum using in method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->in($values))->toBe($result);
})->with([
    [Status::PENDING, [Status::PENDING, Status::ACCEPTED], true],
    [Status::PENDING, [Status::DISCARDED, Status::ACCEPTED], false],
    [Status::PENDING, [], false],
    [Status::PENDING, ['PENDING', 'ACCEPTED'], true],
    [Status::PENDING, ['ACCEPTED', 'DISCARDED'], false],
    [Status::PENDING, ['P'], false],
    [StatusInt::PENDING, [StatusInt::PENDING, Status::ACCEPTED], true],
    [StatusInt::PENDING, [StatusInt::ACCEPTED], false],
    [StatusInt::PENDING, [0, 1, 2], true],
    [StatusInt::PENDING, [2, 3], false],
    [StatusInt::PENDING, [], false],
    [StatusInt::PENDING, ['PENDING'], false],
    [StatusString::PENDING, ['P', 'D'], true],
    [StatusString::PENDING, ['A'], false],
    [StatusString::PENDING, [], false],
    [StatusString::PENDING, [StatusString::PENDING, StatusString::ACCEPTED], true],
    [StatusString::PENDING, [StatusString::ACCEPTED, StatusString::DISCARDED], false],
    [StatusString::PENDING, ['PENDING'], false],
]);

it('can compare enum using notIn method with enum, name and values', function ($enum, array $values, $result) {
    expect($enum->notIn($values))->toBe($result);
})->with([
    [Status::PENDING, [Status::PENDING, Status::ACCEPTED], false],
    [Status::PENDING, [Status::DISCARDED, Status::ACCEPTED], true],
    [Status::PENDING, [], true],
    [Status::PENDING, ['PENDING', 'ACCEPTED'], false],
    [Status::PENDING, ['ACCEPTED', 'DISCARDED'], true],
    [Status::PENDING, ['P'], true],
    [StatusInt::PENDING, [StatusInt::PENDING, Status::ACCEPTED], false],
    [StatusInt::PENDING, [StatusInt::ACCEPTED], true],
    [StatusInt::PENDING, [0, 1, 2], false],
    [StatusInt::PENDING, [2, 3], true],
    [StatusInt::PENDING, [], true],
    [StatusInt::PENDING, ['PENDING'], true],
    [StatusString::PENDING, ['P', 'D'], false],
    [StatusString::PENDING, ['A'], true],
    [StatusString::PENDING, [], true],
    [StatusString::PENDING, [StatusString::PENDING, StatusString::ACCEPTED], false],
    [StatusString::PENDING, [StatusString::ACCEPTED, StatusString::DISCARDED], true],
    [StatusString::PENDING, ['PENDING'], true],
]);

// translation
it('can have a string identifier to translate', function ($enum, $result) {
    expect($enum->toString())->toBe($result);
})->with([
    'Pure Enum' => [Status::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\Status.PENDING'],
    'Int Backed Enum' => [StatusInt::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusInt.PENDING'],
    'String Backed Enum' => [StatusString::PENDING, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusString.PENDING'],
    'Pascal Case' => [StatusPascalCase::Pending, 'Datomatic\EnumHelper\Tests\Support\Enums\StatusPascalCase.Pending'],
]);

test('empty class')->expect(EmptyClass::cases())->toBe([]);
