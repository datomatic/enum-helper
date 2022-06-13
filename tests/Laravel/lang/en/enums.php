<?php

declare(strict_types=1);

use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatus;
use Datomatic\EnumHelper\Tests\Laravel\Enums\LaravelStatusString;

return [
    LaravelStatus::class => [
        'description' => [
            'PENDING' => 'Await decision',
            'ACCEPTED' => 'Recognized valid',
            'DISCARDED' => 'No longer useful',
            'NO_RESPONSE' => 'No response',
        ],
        'excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
        'multipleWordsExcerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
        'multiple_words_excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
    ],
    LaravelStatusString::class => [
        'description' => [
            LaravelStatusString::PENDING->name => 'Await decision',
            LaravelStatusString::ACCEPTED->name => 'Recognized valid',
            LaravelStatusString::DISCARDED->name => 'No longer useful',
            LaravelStatusString::NO_RESPONSE->name => 'No response',
        ],
        'excerpt' => [
            'PENDING' => 'asdkj dskjdsa dkjsa ksjd sadask',
            'ACCEPTED' => 'ls klsa dlksa dlksa salk salk',
            'DISCARDED' => 'ksalsa ld djks jjdk skjd j',
            'NO_RESPONSE' => 'as dklasd asldldlasd',
        ],
    ],
];
