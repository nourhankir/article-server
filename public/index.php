<?php

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../routes/web.php';

// Start the router and dispatch the matched route
$router->dispatch();
