<?php
require_once "settings.php";
require_once "core/db.php";
require_once "core/router.php";

require_once "views/404.php";
require_once "views/home.php";
require_once "views/about.php";
require_once "views/contact.php";
require_once "views/article.php";


$default_home_page = "home";
$router = new Router($default_home_page);

$router->bind(null, notFoundView(...));
$router->bind($default_home_page, homeView(...));
$router->bind('about', aboutView(...));
$router->bind('contact', contactView(...));
$router->bind('article', articleView(...));

$router->route();
?>