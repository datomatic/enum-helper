<?php

declare(strict_types=1);

it('has correct translation text on laravel passing lang', function ($enum, $text, $lang = 'en') {
    expect($enum->translate($lang))->toBe($text);
})->with([
    'eng' => [Status::PENDING, 'Await decision'],
    'ita' => [Status::PENDING, 'In attesa', 'it'],
]);

it('has correct translation text on laravel', function ($enum, $text, $lang = 'en') {
    expect($enum->translate($lang))->toBe($text);
})->with([
    'eng' => [Status::PENDING, 'Await decision'],
    'ita' => [Status::PENDING, 'In attesa', 'it'],
]);
