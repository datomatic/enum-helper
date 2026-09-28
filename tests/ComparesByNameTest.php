<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\IntBackedEnum;
use Datomatic\EnumHelper\Tests\Support\Enums\PureEnum;

it('can compare enum cases by name', function ($a, $b, $result) {
    expect($a::compare($a, $b))->toBe($result);
})->with([
    [PureEnum::ACCEPTED, PureEnum::PENDING, -1],
    [PureEnum::PENDING, PureEnum::DISCARDED, 1],
    [PureEnum::PENDING, PureEnum::PENDING, 0],
]);

it('can sort enum cases using compare as usort callback', function () {
    $cases = PureEnum::cases();
    usort($cases, PureEnum::compare(...));

    expect($cases)->toBe([
        PureEnum::ACCEPTED,
        PureEnum::DISCARDED,
        PureEnum::NO_RESPONSE,
        PureEnum::PENDING,
    ]);
});

it('throws an exception comparing cases of different enums', function ($a, $b) {
    PureEnum::compare($a, $b);
})->with([
    [PureEnum::PENDING, IntBackedEnum::PENDING],
    [IntBackedEnum::PENDING, PureEnum::PENDING],
])->throws(InvalidArgumentException::class);
