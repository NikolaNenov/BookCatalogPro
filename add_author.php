<?php

include 'Author.php';

if (preg_match("/^[a-zA-Zа-яА-Я\ \-`\.]{3,50}$/u", $_POST['name']) === 1) {
    if (isset($_POST['name']) AND trim($_POST['name']) !== '') {
        Author::setAuthor($_POST['name']);
    } else {
        session_start();
        $_SESSION['error'] = '<div class="alert alert-danger">Type name!</div>';
        header('location: add_author_form.php');
        exit();
    }
} else {
    session_start();
    $_SESSION['error'] = '<div class="alert alert-danger">Invalid name!</div>';
    header('location: add_author_form.php');
    exit();
}
    