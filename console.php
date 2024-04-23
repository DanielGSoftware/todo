#!/usr/bin/env php

<?php
require_once __DIR__ . '/vendor/autoload.php';

use Application\DevelopmentServiceContainer;
use Infrastructure\Terminal\Commands\CreateTask;
use Symfony\Component\Console\Application;

$app = new Application();

$serviceContainer = new DevelopmentServiceContainer();
$createTaskService = $serviceContainer->taskService();

$app->add(new CreateTask($createTaskService));
$app->run();
