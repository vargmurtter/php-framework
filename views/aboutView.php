<?php
require_once "core/template.php";

class AboutView 
{
    public function actionIndex(): void
    {
        $tpl = new Template(TEMPLATE_DIR, "base.html");
        $tpl->render("about.html");
    }
}



?>