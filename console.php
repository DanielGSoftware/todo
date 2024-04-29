#!/usr/bin/env php

<?php
require_once __DIR__ . '/vendor/autoload.php';

use Application\DevelopmentServiceContainer;
use Infrastructure\Terminal\Commands\CompleteTask;
use Infrastructure\Terminal\Commands\CreateTask;
use Infrastructure\Terminal\Commands\DisplayTasks;
use Symfony\Component\Console\Application;

$app = new Application();

$serviceContainer = new DevelopmentServiceContainer();

$app->add($serviceContainer->createTaskCommand());
$app->add($serviceContainer->displayTasksCommand());
$app->add($serviceContainer->completeTaskCommand());
$app->run();
