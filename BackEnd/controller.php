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
            case 'sendResetEmail':
                $user->sendResetEmail($username);
                break;
            case 'resendVerifyEmail':
                $user->resendVerifyEmail($email);
                break;
            case 'resetPass':
                $user->resetPass($username, $password);
                break;
            case 'changePass':
                $user->changePass($username, $password, $newPassword);
                break;
            case 'save':
                $user->save($title, $author, $tags, $date, $image, $content, $authorName);
                break;
        }
    }

    header("Location: ../index.php");
?>