<?php

include 'Book.php';

if (preg_match("/^[a-zA-Zа-яА-Я\ \-`\.]{3,30}$/u", $_POST['title']) === 1) {
    if ($_POST) {
        Book::setBook();
    }
} else {
    session_start();
    $_SESSION['error'] = '<div class="alert alert-danger">Invalid title!</div>';
    header('location: add_book_form.php');
    exit();
}