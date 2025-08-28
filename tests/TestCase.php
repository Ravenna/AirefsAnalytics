<?php

namespace Ravenna\AirefsAnalytics\Tests;

use Ravenna\AirefsAnalytics\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
