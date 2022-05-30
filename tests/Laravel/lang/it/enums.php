<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

return [
    LaravelStatus::class => [
        'PENDING' => 'In attesa',
        'ACCEPTED' => 'Accettato',
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ],
    LaravelStatusString::class => [
        'PENDING' => 'In attesa',
        'ACCEPTED' => 'Accettato',
        'DISCARDED' => 'Rifiutato',
        'NO_RESPONSE' => 'Nessuna Risposta',
    ],
];
