<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Exceptions\TranslationMissing;
use Datomatic\EnumHelper\Exceptions\UndefinedStaticMethod;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

it('can has correct translation text on laravel', function ($enum, $result) {
    expect($enum->description())->toBe($result);
})->with([
    [LaravelStatus::PENDING, 'Await decision'],
    [LaravelStatus::NO_RESPONSE, 'No response'],
]);

it('has correct translation text on laravel passing lang', function ($enum, $lang, $result) {
    expect($enum->description($lang))->toBe($result);
})->with([
    'eng' => [LaravelStatus::PENDING,  'en', 'Await decision'],
    'ita' => [LaravelStatus::PENDING, 'it', 'In attesa'],
]);

it('can return a translation with magic method', function ($enum, $result) {
    expect($enum->excerpt())->toBe($result);
})->with([
    [LaravelStatus::PENDING, 'asdkj dskjdsa dkjsa ksjd sadask'],
    [LaravelStatus::NO_RESPONSE, 'as dklasd asldldlasd'],
]);

it('can return a property with magic method', function ($enum, $result) {
    expect($enum->color())->toBe($result);
})->with([
    [LaravelStatus::PENDING, '#000000'],
    [LaravelStatus::NO_RESPONSE, '#FFFFFF'],
]);

it('can return a different translation with excerpt magic method passing lang', function ($enum, $lang, $result) {
    expect($enum->excerpt($lang))->toBe($result);
})->with([
    'eng' => [LaravelStatus::PENDING, 'en', 'asdkj dskjdsa dkjsa ksjd sadask'],
    'ita' => [LaravelStatus::PENDING, 'it', 'ITA asdkj dskjdsa dkjsa ksjd sadask'],
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

it('can return an array of translations with magic method', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::excerpts($cases, $lang))->toBe($result);
})->with([
    'without cases' => [LaravelStatus::class, null, 'en', [
        'asdkj dskjdsa dkjsa ksjd sadask',
        'ls klsa dlksa dlksa salk salk',
        'ksalsa ld djks jjdk skjd j',
        'as dklasd asldldlasd',
    ]],
    'with cases' => [LaravelStatus::class, [LaravelStatus::NO_RESPONSE, LaravelStatus::DISCARDED], 'en', [
        'as dklasd asldldlasd',
        'ksalsa ld djks jjdk skjd j',
    ]],
]);

it('can return an array of properties with magic method', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::colors($cases, $lang))->toBe($result);
})->with([
    [LaravelStatus::class, null, null, ['#000000', '#0000FF', '#FF0000', '#FFFFFF']],
    [LaravelStatus::class, [LaravelStatus::ACCEPTED, LaravelStatus::NO_RESPONSE], 'it', ['#0000FF', '#FFFFFF']],
]);

it('can return an array of properties with magic method with 2 words', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::multipleColors($cases, $lang))->toBe($result);
})->with([
    [LaravelStatus::class, null, null, [['#000000', '#000001'], ['#0000FF', '#0000F1'], ['#FF0000', '#FF0001'], ['#FFFFFF', '#FFFFF1']]],
]);

it('can return an array of translations with magic method with multiple worlds', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::multipleWordsExcerpts($cases, $lang))->toBe($result);
})->with([
    'without cases' => [LaravelStatus::class, null, 'en', [
        'asdkj dskjdsa dkjsa ksjd sadask',
        'ls klsa dlksa dlksa salk salk',
        'ksalsa ld djks jjdk skjd j',
        'as dklasd asldldlasd',
    ]],
    'with cases' => [LaravelStatus::class, [LaravelStatus::NO_RESPONSE, LaravelStatus::DISCARDED], 'en', [
        'as dklasd asldldlasd',
        'ksalsa ld djks jjdk skjd j',
    ]],
]);

it('can return an array of translations with magic method with multiple worlds _', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::multiple_words_excerpts($cases, $lang))->toBe($result);
})->with([
    'without cases' => [LaravelStatus::class, null, 'en', [
        'asdkj dskjdsa dkjsa ksjd sadask',
        'ls klsa dlksa dlksa salk salk',
        'ksalsa ld djks jjdk skjd j',
        'as dklasd asldldlasd',
    ]],
    'with cases' => [LaravelStatus::class, [LaravelStatus::NO_RESPONSE, LaravelStatus::DISCARDED], 'en', [
        'as dklasd asldldlasd',
        'ksalsa ld djks jjdk skjd j',
    ]],
]);

it('can return an associative array of translations [name => translations]', function ($enumClass, $result) {
    expect($enumClass::descriptionsByName())->toBe($result);
})->with([
    'Pure Enum' => [LaravelStatus::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Backed Enum' => [LaravelStatusString::class, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
]);

it('can return an associative array of translations [value => translations]', function ($enumClass, $result) {
    expect($enumClass::descriptionsByValue())->toBe($result);
})->with([
    'Backed Enum' => [LaravelStatusString::class, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
]);

it('can return an associative array of translations [name => translations] with params', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::descriptionsByName($cases, $lang))->toBe($result);
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
        'PENDING' => 'In attesa',
        'ACCEPTED' => 'Accettato',
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ]],
    'Some string backed Enum cases into it ' => [LaravelStatusString::class, [LaravelStatusString::NO_RESPONSE, LaravelStatusString::NO_RESPONSE], 'it', [
        'NO_RESPONSE' => 'Nessuna Risposta',
    ]],
]);

it('can return an associative array of translations [value => translations] with params', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::descriptionsByValue($cases, $lang))->toBe($result);
})->with([
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

it('can return an associative array of translations [name => translations] with excerpt magic method', function ($enumClass, $result) {
    expect($enumClass::excerptsByName())->toBe($result);
})->with([
    [LaravelStatus::class, [
        'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
        'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
        'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
        'NO_RESPONSE' => 'as dklasd asldldlasd',
    ]],
]);

it('can return an associative array of properties [name => translations] with excerpt magic method', function ($enumClass, $result) {
    expect($enumClass::colorsByName())->toBe($result);
})->with([
    [LaravelStatus::class, [
        'PENDING' => '#000000',
        'ACCEPTED' => '#0000FF',
        'DISCARDED' => '#FF0000',
        'NO_RESPONSE' => '#FFFFFF',
    ]],
]);

it('can return an associative array of translations [value => translations] with excerpt magic method', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::excerptsByValue($cases, $lang))->toBe($result);
})->with([
    [LaravelStatusString::class, null, null, [
        'P' => 'asdkj dskjdsa dkjsa ksjd sadask',
        'A' => 'ls klsa dlksa dlksa salk salk',
        'D' => 'ksalsa ld djks jjdk skjd j',
        'N' => 'as dklasd asldldlasd',
    ]],
    [LaravelStatusString::class, [LaravelStatusString::DISCARDED, LaravelStatusString::ACCEPTED], 'it', [
        'D' => 'ITA ksalsa ld djks jjdk skjd j',
        'A' => 'ITA ls klsa dlksa dlksa salk salk',
    ]],
]);

it('can return an associative array of properties [value => translations] with excerpt magic method', function ($enumClass, $cases, $lang, $result) {
    expect($enumClass::colorsByValue($cases, $lang))->toBe($result);
})->with([
    [LaravelStatusString::class, null, null, [
        'P' => '#000000',
        'A' => '#0000FF',
        'D' => '#FF0000',
        'N' => '#FFFFFF',
    ]],
    [LaravelStatusString::class, [LaravelStatusString::DISCARDED, LaravelStatusString::ACCEPTED], 'it', [
        'D' => '#FF0000',
        'A' => '#0000FF',
    ]],
]);

it('can return an associative array [value/name => translation]', function ($className, $cases, $lang, $values) {
    expect($className::descriptionsAsSelect($cases, $lang))->toBe($values);
})->with([
    'Pure Enum' => [LaravelStatus::class, null, null, [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ]],
    'Pure Enum subset' => [LaravelStatus::class, [LaravelStatus::PENDING, LaravelStatus::DISCARDED], 'it', [
        'PENDING' => 'In attesa',
        'DISCARDED' => 'Rifiutato',
    ]],
    'Backed Enum' => [LaravelStatusString::class, null, null, [
        'P' => 'Await decision',
        'A' => 'Recognized valid',
        'D' => 'No longer useful',
        'N' => 'No response',
    ]],
    'Backed Enum subset' => [LaravelStatusString::class,
        [LaravelStatusString::DISCARDED, LaravelStatusString::ACCEPTED], 'it', [
        'D' => 'Rifiutato',
        'A' => 'Accettato',
    ], ],
]);

it('throw an TranslationMissing exception', function () {
    LaravelStatus::notExistes();
})->throws(TranslationMissing::class);

it('throw an UndefinedStaticMethod exception', function () {
    LaravelStatus::bloba();
})->throws(UndefinedStaticMethod::class);
