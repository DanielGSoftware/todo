#!/usr/bin/env php

<?php
require_once __DIR__ . '/vendor/autoload.php';

use Application\DevelopmentServiceContainer;
use Infrastructure\Terminal\Commands\CreateTask;
use Infrastructure\Terminal\Commands\DisplayTasks;
use Symfony\Component\Console\Application;

$app = new Application();

$serviceContainer = new DevelopmentServiceContainer();
$createTaskService = $serviceContainer->createTaskService();
$retrieveTaskService = $serviceContainer->retrieveTasksService();

$app->add(new CreateTask($createTaskService));
$app->add(new DisplayTasks($retrieveTaskService));
$app->run();
