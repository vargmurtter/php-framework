<?php

require_once "settings.php";
require_once "core/db.php";
require_once "core/router.php";

$router = new Router();
$router->route();

?>