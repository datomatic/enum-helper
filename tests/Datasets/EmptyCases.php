<?php

use Datomatic\EnumHelper\Tests\Support\Enums\EmptyClass;
use Datomatic\EnumHelper\Tests\Support\Enums\Status;
use Datomatic\EnumHelper\Tests\Support\Enums\StatusString;

dataset('emptyCases', [
    'pure enum' => [Status::class, []],
    'backed enum' => [StatusString::class, []],
    'empty cases enum' => [EmptyClass::class, null]
]);