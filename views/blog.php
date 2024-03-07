<?php
require_once "core/template.php";
require_once "models/blog.php";


function blogView(array $params): void
{
    // $entries = Blog::select_many(condition: "id = 795", limit: 1, order_field: 'id', order_type: SqlOrderType::DESC);
    // $entries = Blog::all();
    // foreach ($entries as $entry) {
    //     echo $entry->id . " " . $entry->title . "<br>";
    // }

    $entry = Blog::get(17);
    if ($entry == null) return;
    
    echo $entry->title;

    $tpl = new Template(TEMPLATE_DIR, "base.html");
    $tpl->render("blog.html");
}

?>