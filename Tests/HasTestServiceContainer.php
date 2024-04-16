<?php

namespace Tests;

trait HasTestServiceContainer
{
    protected TestServiceContainer $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new TestServiceContainer();
    }
}