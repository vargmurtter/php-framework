<?php
require_once "core/template.php";
require_once "models/article.php";


function homeView(array $params): void
{
    $articles = Article::select_many(
        limit: 5, 
        order_field: 'creation_date', 
        order_type: SqlOrderType::DESC
    );
    
    $tpl = new Template(TEMPLATE_DIR, "base.html");
    $tpl->render("index.html", ['articles' => $articles]);
}

?>