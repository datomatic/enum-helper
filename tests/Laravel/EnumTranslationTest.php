<?php

declare(strict_types=1);

it('can has correct translation text on laravel passing lang', function ($enum, $text, $lang = 'en') {
    expect($enum->translate($lang))->toBe($text);
})->with([
    [Status::PENDING, 'Await decision'],
    [Status::PENDING, 'In attesa', 'it'],
]);

it('can has correct translation text on laravel', function ($enum, $text, $lang = 'en') {
    expect($enum->translate($lang))->toBe($text);
})->with([
    [Status::PENDING, 'Await decision'],
    [Status::PENDING, 'In attesa', 'it'],
]);
