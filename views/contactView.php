<?php
require_once "core/template.php";
require_once "models/message.php";


class ContactView 
{
    public function actionIndex(): void
    {
        $success_message = null;
        $error_message = null;

        if (isset($_POST['send_btn'])) {

            if (isset($_POST['name'])) $name = $_POST['name'];
            if (isset($_POST['email'])) $email = $_POST['email'];
            if (isset($_POST['phone'])) $phone = $_POST['phone'];
            if (isset($_POST['message'])) $message_text = $_POST['message'];

            if (empty($name)) $error_message = "Name is empty";
            if (empty($email)) $error_message = "Email is empty";
            if (empty($phone)) $error_message = "Phone is empty";
            if (empty($message_text)) $error_message = "Message is empty";
            
            if ($error_message == null) {
                $message = new Message($name, $email, $phone, $message_text);
                $message->insert();
                $success_message = "Form submission successful!";
            }
        }

        $tpl = new Template(TEMPLATE_DIR, "base.html");

        $data = [
            "title" => "Contact",
            "success_message" => $success_message,
            "error_message" => $error_message,
        ];
        $tpl->render("contact.html", $data);
    }
}

?>