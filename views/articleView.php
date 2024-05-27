<?php
require_once "core/template.php";
require_once "models/article.php";

class ArticleView 
{
    public function actionId(): void
    {
        $tpl = new Template(TEMPLATE_DIR, "base.html");
    
        $url = $_SERVER["REQUEST_URI"];
        $url = preg_replace("/\?.*/", "", $url);
        $url = explode("/", $url);
        
        if (!array_key_exists(3, $url)) {
            header("Location: /");
            return;
        }

        $id = $url[3];
        if (ctype_digit($id)) {
            $id = (int)$id;
        } else {
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
}


?>