<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\NumericStringBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\StringBackedEnum;

it('can compare enum cases by value', function ($a, $b, $result) {
    expect($a::compare($a, $b))->toBe($result);
})->with([
    [IntBackedEnum::PENDING, IntBackedEnum::ACCEPTED, -1],
    [IntBackedEnum::NO_RESPONSE, IntBackedEnum::ACCEPTED, 1],
    [IntBackedEnum::ACCEPTED, IntBackedEnum::ACCEPTED, 0],
    [StringBackedEnum::ACCEPTED, StringBackedEnum::PENDING, -1],
    [StringBackedEnum::PENDING, StringBackedEnum::DISCARDED, 1],
    [StringBackedEnum::PENDING, StringBackedEnum::PENDING, 0],
    [NumericStringBackedEnum::TEN, NumericStringBackedEnum::NINE, -1],
    [NumericStringBackedEnum::NINE, NumericStringBackedEnum::TEN, 1],
]);

it('can sort enum cases using compare as usort callback', function () {
    $cases = StringBackedEnum::cases();
    usort($cases, StringBackedEnum::compare(...));

    expect($cases)->toBe([
        StringBackedEnum::ACCEPTED,
        StringBackedEnum::DISCARDED,
        StringBackedEnum::NO_RESPONSE,
        StringBackedEnum::PENDING,
    ]);
});

it('throws an exception comparing cases of different enums', function ($a, $b) {
    StringBackedEnum::compare($a, $b);
})->with([
    [StringBackedEnum::PENDING, IntBackedEnum::PENDING],
    [IntBackedEnum::PENDING, StringBackedEnum::PENDING],
    [NumericStringBackedEnum::NINE, NumericStringBackedEnum::TEN],
])->throws(InvalidArgumentException::class);
