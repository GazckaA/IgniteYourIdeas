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
            case 'update':
                $user->update($username, $name, $lastname, $email, $description, $birthdate, $origin, $image, $role);
                break;
            case 'updatePost':
                $user->updatePost($id, $title, $tags, $date, $image, $content);
                break;
            case 'deletePost':
                $user->deletePost($id);
                break;
            case 'deleteUser':
                $user->deleteUser($username, $password);
                break;
            case 'adminPass':
                $user->adminPass( $password);
                break;
            case 'review':
                $user->review($rating, $username, $review, $id);
                break;
        }
    }

    header("Location: ../index.php");
?>