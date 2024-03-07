<?php
require_once "core/db.php";
require_once "core/base_model.php";


class Blog extends BaseModel
{
    function __construct(
        public string $title,
        public string $description, 
        public string $text, 
        public int $author_id
    ) { parent::__construct(); }

    const TABLE_NAME = "blog";
}

?>