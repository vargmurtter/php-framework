<?php
require_once "utils.php";
require_once "core/template.php";
require_once "models/userModel.php";


class UnfoundView 
{
    public function actionIndex(): void
    {
        header('HTTP/1.0 404 Not Found');
        $tpl = new Template(TEMPLATE_DIR, "_base.html");
        $data = [
            'title' => "Не найдено :c",
        ];
        $tpl->render("404.html", $data);
    }
}


?>