<?php

include 'User.php';

if ($_POST) {

    User::loginUser();
} else {
    header('location: index.php');
    exit();
}