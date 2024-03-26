<?php
require_once "core/template.php";
require_once "models/article.php";


function articleView(array $params): void
{
    if (!array_key_exists(0, $params)) {
        header("Location: /");
        return;
    }

    $tpl = new Template(TEMPLATE_DIR, "base.html");

    $id = $params[0];
    if (ctype_digit($id)) {
        $id = (int)$id;
    }else{
        $tpl->render("404.html");
        return;
    }

    $article = Article::get($id);
    if ($article == null) {
        $tpl->render("404.html");
        return;
    }

    $data = [
        'title' => $article->title,
        'text' => $article->text,
        'date' => $article->creation_date
    ];
    $tpl->render("post.html", $data);
    
}

?>