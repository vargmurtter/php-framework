<?php
require_once "core/template.php";


function notFoundView(array $params): void
{
    $tpl = new Template(TEMPLATE_DIR, "base.html");
    $tpl->render("404.html");
}

?>