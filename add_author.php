<?php

include 'Author.php';

if (isset($_POST['name']) AND trim($_POST['name']) !== '') {
    Author::setAuthor($_POST['name']);
} else {
    session_start();
    $_SESSION['error'] = '<div class="alert alert-danger">Type name!</div>';
    header('location: add_author_form.php');
    exit();
}
    