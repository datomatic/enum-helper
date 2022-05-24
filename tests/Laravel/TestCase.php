<?php

namespace Datomatic\EnumHelper\Tests\Laravel;

use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['path.lang'] = __DIR__ . '/lang';
    }
}
