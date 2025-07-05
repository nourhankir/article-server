<?php

require_once __DIR__ . '/../app/Core/Router.php';

// ✅ You must instantiate the Router
$router = new Router();

// ✅ Then load your route definitions
require_once __DIR__ . '/../routes/web.php';

// ✅ Then dispatch the matching route
$router->dispatch();

