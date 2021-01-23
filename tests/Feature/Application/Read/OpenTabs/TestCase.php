<?php

namespace Tests\Feature\Application\Read\OpenTabs;

use Codderz\Yoko\Layers\Application\Read\ReadModel\ReadModelTestTrait;
use Codderz\Yoko\Layers\Infrastructure\Container\ContainerTestTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Src\Application\Read\OpenTabs\OpenTabsInterface;
use Tests\FixtureTestTrait;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations,
        FixtureTestTrait,
        ReadModelTestTrait,
        ContainerTestTrait;

    protected OpenTabsInterface $openTabs;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFixture();
        $this->openTabs = $this->container()->make(OpenTabsInterface::class);
    }
}
