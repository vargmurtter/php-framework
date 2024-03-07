<?php

$_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);

if ($_db->connect_errno)
{
    printf("Не удалось подключиться к БД: %s\n", $mysqli->connect_error);
    exit();
}


?>