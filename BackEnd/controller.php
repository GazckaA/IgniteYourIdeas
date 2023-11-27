<?php

    include 'model.php';

    //create user instance
    $user = new User();

    if(isset($_POST)){
        extract($_POST);
        switch($operation){
            case 'login':
                $user->login($username, $password);
                break;
            case 'register':
                $user->register($name, $lastname, $username, $email, $password);
                break;
        }
    }

?>