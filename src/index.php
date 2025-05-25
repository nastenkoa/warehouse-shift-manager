<?php
require_once 'autoload.php';

if(Auth::check())
{
    header('Location: views/add_data.php');
}
else
{
    header('Location: views/login.php');
}




?>