<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

return [
    LaravelStatus::class => [
        'PENDING' => 'Await decision',
        'ACCEPTED' => 'Recognized valid',
        'DISCARDED' => 'No longer useful',
        'NO_RESPONSE' => 'No response',
    ],
    LaravelStatusString::class => [
        LaravelStatusString::PENDING->name => 'Await decision',
        LaravelStatusString::ACCEPTED->name => 'Recognized valid',
        LaravelStatusString::DISCARDED->name => 'No longer useful',
        LaravelStatusString::NO_RESPONSE->name => 'No response',
    ],
];
