<?php
require_once "core/template.php";


function homeView(array $params): void
{
    $tpl = new Template(TEMPLATE_DIR, "base.html");
    $tpl->render("home.html", ['title' => 'Home page']);
}

?>