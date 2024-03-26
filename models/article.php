<?php 
require_once "core/base_model.php";


class Article extends BaseModel
{
    const TABLE_NAME = "articles";

    function __construct(
        public string $title,
        public string $description, 
        public string $text, 
        public string $creation_date
    ) 
    { parent::__construct(); }

    
}

?>