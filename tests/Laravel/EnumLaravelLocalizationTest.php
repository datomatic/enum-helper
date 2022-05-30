<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

it('has correct translation text on laravel passing lang', function ($enum, $text, $lang = 'en') {
    expect($enum->description($lang))->toBe($text);
})->with([
    'eng' => [LaravelStatus::PENDING, 'Await decision'],
    'ita' => [LaravelStatus::PENDING, 'In attesa', 'it'],
]);

it('can has correct translation text on laravel', function ($enum, $text) {
    expect($enum->description())->toBe($text);
})->with([
    [LaravelStatus::PENDING, 'Await decision'],
    [LaravelStatus::NO_RESPONSE, 'No response'],
]);

it('can return an array of translations', function ($enumClass, $result) {
    expect($enumClass::descriptions())->toBe($result);
})->with([
    [LaravelStatus::class, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
    [LaravelStatusString::class, [
        'Await decision',
        'Recognized valid',
        'No longer useful',
        'No response',
    ]],
]);

it('can return an array of translations with cases and lang param', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::descriptions($cases, $lang))->toBe($result);
})->with([
    'All Enum cases into it ' => [LaravelStatus::class, null, 'it', [
        'In attesa',
        'Accettato',
        'Rifiutato',
        'Nessuna Risposta',
    ]],
    'Some Enum cases into en ' => [LaravelStatusString::class, [LaravelStatusString::NO_RESPONSE, LaravelStatusString::DISCARDED], 'en', [
        'No response',
        'No longer useful',
    ]],
]);

it('can return an associative array of translations [value/name => translations]', function ($enumClass, $result) {
    expect($enumClass::descriptionsArray())->toBe($result);
})->with([
    'Pure Enum' => [LaravelStatus::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed Enum' => [LaravelStatusString::class, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
]);

it('can return an associative array of translations [value/name => translations] with params', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::descriptionsArray($cases, $lang))->toBe($result);
})->with([
    'All Enum cases into en ' => [LaravelStatus::class, null, 'en', [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Some cases into it ' => [LaravelStatus::class, [LaravelStatus::DISCARDED, LaravelStatus::NO_RESPONSE], 'it', [
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ]],
    'All string backed Enum cases into it ' => [LaravelStatusString::class, null, 'it', [
        'P' => 'In attesa',
        'A' => 'Accettato',
        'D' => 'Rifiutato',
        'N' => 'Nessuna Risposta',
    ]],
    'Some string backed Enum cases into it ' => [LaravelStatusString::class, [LaravelStatusString::NO_RESPONSE, LaravelStatusString::NO_RESPONSE], 'it', [
        'N' => 'Nessuna Risposta',
    ]],
]);
