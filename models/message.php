<?php 
require_once "core/base_model.php";


class Message extends BaseModel
{
    const TABLE_NAME = "contact_form";
    
    public string $name;
    public string $email; 
    public string $phone;
    public string $message;
    public string $creation_date;

    function __construct(
        string $name,
        string $email, 
        string $phone, 
        string $message, 
        string $creation_date = null
    ) 
    {
        parent::__construct();
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->creation_date = $creation_date ? $creation_date : date('Y-m-d H:i:s');
    }
}

?>