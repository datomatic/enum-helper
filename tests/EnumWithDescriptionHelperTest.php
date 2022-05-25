<?php

declare(strict_types=1);

it('can return an associative array [value => description]', function ($className, $values) {
    expect($className::asDescriptionsArray())->toBe($values);
})->with([
    'Pure Enum' => [Status::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Reconized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed Enum' => [StatusString::class, [
        'P' => 'Await decision',
        'A' => 'Reconized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
]);

it('can return an associative array [description => value]', function ($className, $values) {
    expect($className::asDescriptionsArrayInverse())->toBe($values);
})->with([
    'Pure Enum' => [Status::class, [
        'Await decision' => 'PENDING',
        'Reconized valid' => 'ACCEPTED',
        'No longer useful' => 'DISCARDED',
        'No response' => 'NO_RESPONSE',
        ]],
    'Backed Enum' => [StatusString::class, [
        'Await decision' => 'P',
        'Reconized valid' => 'A',
        'No longer useful' => 'D',
        'No response' => 'N',
    ]],
    ]);
