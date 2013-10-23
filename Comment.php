<?php

include_once 'DbConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author Nikola Nenov
 */
class Comment {

    //put your code here
    public static function getComments($title) {

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT * FROM comments LEFT JOIN books ON comments.book_id=books.book_id LEFT JOIN users ON users.user_id=comments.user_id WHERE book_title=\'' . mysqli_real_escape_string($link, $title) . '\' ORDER BY comment_date DESC');
        if ($result->num_rows > 0) {
            echo '<table style="color:#999999"><tr><td style="border-bottom: 1px solid">Дата:</td><td style="border-bottom: 1px solid; color:white">Коментар:&nbsp&nbsp&nbsp</td><td style="border-bottom: 1px solid">Публикуван от:</td></tr>';
            while ($row = $result->fetch_object()) {
                echo '<tr><td>' . date("m.d.Y", strtotime($row->comment_date)) . '&nbsp&nbsp&nbsp</td><td style="color:white">' . $row->comment_text . '&nbsp&nbsp</td><td>' . $row->user_name . '</td></tr>';
            }
            echo '</table>';
        } else {
            echo '<div style="color:white">Няма коментари за тази книга!</div>';
        }
    }

    public static function setComment($title) {

        $link = DbConnection::dbConnect();
        $res = $link->query('SELECT book_title FROM books WHERE book_title=\'' . mysqli_real_escape_string($link, $title) . '\'');
        if ($res->num_rows > 0) {
            $result = $link->query('INSERT INTO comments( comment_text, user_id, book_id ) 
                                SELECT  \'' . mysqli_real_escape_string($link, trim($_POST['comment'])) . '\',\'' . mysqli_real_escape_string($link, $_SESSION['user_id']) . '\', book_id 
                                FROM books WHERE book_title=\'' . mysqli_real_escape_string($link, $_SESSION['book_title']) . '\'');


            if ($result) {
                header('location: book_comments.php?id=' . $_SESSION['book_title'] . '');
                exit();
            }
        } else {
            echo '<div class="alert alert-danger">No such book!</div>';
        }
    }

}

?>
