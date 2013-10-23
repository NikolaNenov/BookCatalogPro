<?php

include_once 'DbConnection.php';
/*
 * 
 */

/**
 * Description of Author
 *
 * @author Nikola Nenov
 */
class Author {

    private $name;
    private $id;

    private function __construct() {
        ;
    }

    /**
     * Add new author.
     * @param string between 2 and 30 chars
     */
    public static function setAuthor($name) {

        if (mb_strlen(trim($name)) > 1 AND mb_strlen(trim($name) < 31)) {
            $link = DbConnection::dbConnect();
            $result = $link->query('SELECT author_name FROM authors WHERE author_name=\'' . mysqli_real_escape_string($link, trim($name)) . '\'');

            if ($result->num_rows > 0) {
                echo '<div class="alert alert-danger">The author already exist!<div>';
            } else {
                $result = $link->query('INSERT INTO authors (author_name) VALUE (\'' . mysqli_real_escape_string($link, trim($name)) . '\')');
                unset($_POST);
                header('location: add_author_form.php');
                exit();
            }
        } else {
            session_start();
            $_SESSION['error'] = '<div class="alert alert-danger">Името трябва да е от 2 до 30 символа!</div>';
            header('location: add_author_form.php');
            exit();
        }
    }

    public static function printAllAuthors() {

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT author_name FROM authors');

        while ($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="books_by.php?id=' . $row['author_name'] . '" style="color:#999999"><span class="glyphicon glyphicon-user"></span> ' . $row['author_name'] . '</a></td></tr>';
        }
    }

    public static function printAuthorsAsOptions() {

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT * FROM authors');

        //var_dump($result);
        while ($row = $result->fetch_object()) {
            echo '<option value=\'' . $row->author_id . '\'>' . $row->author_name . '</option>';
        }
    }

}

?>
