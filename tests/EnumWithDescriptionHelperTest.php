<?php

use Datomatic\EnumHelper\Exceptions\UndefinedCase;

it('can return an associative array [value => description]',function($className,$values){
    expect($className::asDescriptionsArray())->toBe($values);
})->with([
    [Status::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Reconized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response'
    ]],
    [StatusString::class, [
        'P' => 'Await decision',
        'A' => 'Reconized valid',
        'D' => 'No longer useful',
        'N' => 'No response'
    ]]
]);

it('can return an associative array [description => value]',function($className,$values){
    expect($className::asDescriptionsArrayInverse())->toBe($values);
})->with([
    [Status::class,[
        'Await decision' => 'PENDING',
        'Reconized valid' => 'ACCEPTED',
        'No longer useful' => 'DISCARDED',
        'No response' => 'NO_RESPONSE'
        ]],
    [StatusString::class,[
        'Await decision' => 'P',
        'Reconized valid' => 'A',
        'No longer useful' => 'D',
        'No response' => 'N'
    ]],
    ]);


