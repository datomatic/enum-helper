<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

return [
    LaravelStatus::class => [
        'description' => [
            'PENDING' => 'In attesa',
            'ACCEPTED' => 'Accettato',
            'DISCARDED' => 'Rifiutato',
            'NO_RESPONSE' => 'Nessuna Risposta',
        ],
        'excerpt' => [
            'PENDING' => 'ITA asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ITA ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ITA ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'ITA as dklasd asldldlasd',
        ]
    ],
    LaravelStatusString::class => [
        'description' => [
            'PENDING' => 'In attesa',
            'ACCEPTED' => 'Accettato',
            'DISCARDED' => 'Rifiutato',
            'NO_RESPONSE' => 'Nessuna Risposta',
        ],
        'excerpt' => [
            'PENDING' => 'ITA asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ITA ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ITA ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'ITA as dklasd asldldlasd',
        ]
    ],
];
