<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'true');

chdir(dirname(__DIR__));

include 'vendor/autoload.php';

Zend\Mvc\Application::init(
    require 'config/application.config.php'
)->run();
