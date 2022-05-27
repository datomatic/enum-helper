<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

it('has correct translation text on laravel passing lang', function ($enum, $text, $lang = 'en') {
    expect($enum->translate($lang))->toBe($text);
})->with([
    'eng' => [Status::PENDING, 'Await decision'],
    'ita' => [Status::PENDING, 'In attesa', 'it'],
]);

it('can has correct translation text on laravel', function ($enum, $text) {
    expect($enum->translate())->toBe($text);
})->with([
    [Status::PENDING, 'Await decision'],
    [Status::NO_RESPONSE, 'No response'],
]);

it('can return an array of translations', function ($enumClass, $result) {
    expect($enumClass::translations())->toBe($result);
})->with([
    [Status::class, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
    [StatusString::class, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
]);

it('can return an array of translations with cases and lang param', function ($enumClass, $lang, $cases, $result) {
    expect($enumClass::translations($lang, $cases))->toBe($result);
})->with([
    'All Enum cases into it ' => [Status::class, 'it', null, [
        'In attesa',
        'Accettato',
        'Rifiutato',
        'Nessuna Risposta',
    ]],
    'Some Enum cases into en ' => [StatusString::class, 'en', [StatusString::NO_RESPONSE, StatusString::DISCARDED], [
        'No response',
        'No longer useful',
    ]],
]);

it('can return an associative array of translations [value/name => translations]', function ($enumClass, $result) {
    expect($enumClass::translationsArray())->toBe($result);
})->with([
    'Pure Enum' => [Status::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed Enum' => [StatusString::class, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
]);

it('can return an associative array of translations [value/name => translations] with params', function ($enumClass, $lang, $cases, $result) {
    expect($enumClass::translationsArray($lang, $cases))->toBe($result);
})->with([
    'All Enum cases into en ' => [Status::class, 'en', null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Some cases into it ' => [Status::class, 'it', [Status::DISCARDED, Status::NO_RESPONSE], [
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ]],
    'All string backed Enum cases into it ' => [StatusString::class, 'it', null, [
        'P' => 'In attesa',
        'A' => 'Accettato',
        'D' => 'Rifiutato',
        'N' => 'Nessuna Risposta',
    ]],
    'Some string backed Enum cases into it ' => [StatusString::class, 'it', [StatusString::NO_RESPONSE, StatusString::NO_RESPONSE], [
        'N' => 'Nessuna Risposta',
    ]],
]);
