<?php
/* start session */
if(!session_id()) session_start();

/* start session */
$routes = require_once __DIR__ . "/../App/routes.php";
$route  = new \Core\Route($routes);


