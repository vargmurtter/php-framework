<?php
require_once "core/template.php";


function aboutView(array $params): void
{
    $tpl = new Template(TEMPLATE_DIR, "base.html");
    $tpl->render("about.html");
}

?>