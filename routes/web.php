<?php

use Controllers\HomeController;

/** @var \FastRoute\RouteCollector $router */

$router->addRoute('GET', '/', [HomeController::class, 'index']);
