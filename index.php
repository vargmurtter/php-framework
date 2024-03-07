<?php
require_once "settings.php";
require_once "core/db.php";
require_once "core/router.php";
require_once "views/404.php";
require_once "views/home.php";
require_once "views/blog.php";


$default_home_page = "home";
$router = new Router($default_home_page);

$router->bind(null, notFoundView(...));
$router->bind($default_home_page, homeView(...));
$router->bind('blog', blogView(...));

$router->route();
?>