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
        Comment::setComment($_SESSION['book_title']);
    } else {
        $_SESSION['error'] = '<div class="alert alert-danger">Please, write your comment.</div>';
        header('location: add_comment_form.php?id=' . $_SESSION['book_title'] . '');
        exit();
    }
}