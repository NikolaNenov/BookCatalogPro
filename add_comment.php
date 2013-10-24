<?php

include 'Comment.php';
session_start();

if (!isset($_SESSION['is_logged']) == 1) {
    header('location: login.php');
    exit();
}
if (!isset($_SESSION['book_title']) || isset($_SESSION['book_title']) == '') {
    header('location:index.php');
    exit();
}

if ($_POST) {
    if ($_POST['comment'] != '') {
        if (preg_match("/^[a-zA-Zа-яА-Я\ \-`\.]{3,30}$/u", $_POST['comment']) === 1) {
            Comment::setComment($_SESSION['book_title']);
        } else {
            session_start();
            $_SESSION['error'] = '<div class="alert alert-danger">Invalid chars!</div>';
            header('location: add_comment_form.php');
            exit();
        }
    } else {
        $_SESSION['error'] = '<div class="alert alert-danger">Please, write your comment.</div>';
        header('location: add_comment_form.php?id=' . $_SESSION['book_title'] . '');
        exit();
    }
}
