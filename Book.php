<?php

include_once 'DbConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author Nikola Nenov
 */
class Book {

    private function __construct() {
        ;
    }

    public static function setBook() {

        if (trim($_POST['title']) !== '') {
            $link = DbConnection::dbConnect();
            $result = $link->query('SELECT COUNT(book_title) FROM books WHERE book_title =\'' . mysqli_real_escape_string($link, $_POST['title']) . '\'');
            $row = $result->fetch_assoc();

            if (!$row['COUNT(book_title)'] > 0) {
                if (isset($_POST['selected_authors'])) {
                    $result = $link->query('INSERT INTO books (book_title) VALUE (\'' . mysqli_real_escape_string($link, trim($_POST['title'])) . '\')');
                    $book_id = mysqli_insert_id($link);
                    $selected_authors = $_POST['selected_authors'];

                    foreach ($selected_authors as $value) {
                        $result = $link->query('INSERT INTO books_authors( author_id,book_id) VALUES (\'' . mysqli_real_escape_string($link, $value) . '\',\'' . $book_id . '\')');
                    }
                    header('location: index.php');
                    exit();
                } else {
                    session_start();
                    $_SESSION['error'] = '<div class="alert alert-danger">Select an author!</div>';
                    header('location: add_book_form.php');
                    exit();
                }
            } else {
                session_start();
                $_SESSION['error'] = '<div class="alert alert-danger">The book already exist!</div>';
                header('location: add_book_form.php');
                exit();
            }
        } else {
            session_start();
            $_SESSION['error'] = '<div class="alert alert-danger">Type title between 3 and 30 chars!</div>';
            header('location: add_book_form.php');
            exit();
        }
    }

    public static function printAllBooks() {

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT book_title,author_name,
                                case when comments.book_id is not null then COUNT(*)
                                else 
                                0 
                                end as comments_count
                                FROM books
                                LEFT JOIN books_authors ON books_authors.book_id=books.book_id 
                                LEFT JOIN authors ON authors.author_id=books_authors.author_id 
                                left  JOIN comments ON books.book_id=comments.book_id 
                                GROUP BY  book_title,author_name');
        $sort = array();

        while ($value = mysqli_fetch_assoc($result)) {

            $sort[$value['book_title']]['title'] = $value['book_title'];
            $sort[$value['book_title']]['author'][] = $value['author_name'];
            $sort[$value['book_title']]['comments_count'] = $value['comments_count'];
        }

        echo '<table>
                 <tr>
                    <td style="border-bottom: 1px solid white; color:white">Books</td>
                    <td style="border-bottom: 1px solid #999999; color:#999999">Authors</td>
                    <td style="border-bottom: 1px solid white; color:white">Comments</td>
                </tr>
                  <tr>
                    <td> </td><td> </td>
                 </tr>';

        foreach ($sort as $value) {
            echo '<tr><td><a href="book_comments.php?id=' . $value['title'] . '" style="color:white">
                <span class="glyphicon glyphicon-book"></span> ' . $value['title'] . '</a>&nbsp&nbsp&nbsp&nbsp
                    </td>
                    <td>';
            foreach ($value['author'] as $val) {
                echo '<a href="books_by.php?id=' . $val . '" style="color:#999999">' . $val . '</a>&nbsp &nbsp';
            }
            echo '</td>
                  <td style="color:white">' . $value['comments_count'] . '</td>
                </tr>';
        }
        echo '</table>';
    }

    public static function printAllBooksBy($author) {
        $author_exist = 0;

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT book_title,author_name,
                                case when comments.book_id is not null then COUNT(*)
                                else 
                                0 
                                end as comments_count
                                FROM books
                                LEFT JOIN books_authors ON books_authors.book_id=books.book_id 
                                LEFT JOIN authors ON authors.author_id=books_authors.author_id 
                                left  JOIN comments ON books.book_id=comments.book_id 
                                GROUP BY  book_title,author_name');
        $sort = array();
        while ($value = mysqli_fetch_assoc($result)) {
            if ($author == $value['author_name']) {
                $author_exist = 1;
            }
            $sort[$value['book_title']]['title'] = $value['book_title'];
            $sort[$value['book_title']]['author'][] = $value['author_name'];
            $sort[$value['book_title']]['comments_count'] = $value['comments_count'];
        }
        echo '<div style="color:white">All books by <b>' . $author . '</b>.</div>
        <br/>            
        <table>
                 <tr>
                    <td style="border-bottom: 1px solid white; color:white">Books</td>
                    <td style="border-bottom: 1px solid #999999; color:#999999">Authors</td>
                    <td style="border-bottom: 1px solid white; color:white">Comments</td>                 
                 </tr>
                  <tr>
                    <td> </td><td> </td><td> </td>
                 </tr>';
        foreach ($sort as $value) {

            $selected_author = array_search($author, $value['author']);

            if ($selected_author > -1) {
                echo '<tr><td><a href="book_comments.php?id=' . $value['title'] . '"  style="color:white">
                        <span class="glyphicon glyphicon-book"></span> ' . $value['title'] . '</a>&nbsp&nbsp
                     </td>
                     <td>';
                foreach ($value['author'] as $val) {
                    echo '<a href="books_by.php?id=' . $val . '" style="color:#999999">' . $val . '</a>&nbsp&nbsp';
                }
                echo '</td>
                          <td style="color:white">' . $value['comments_count'] . '</td>                        
                        </tr>';
                $selected_author = -1;
            }

            if ($author_exist !== 1) {
                echo '<br/><p><div class="alert alert-danger">No such author!</div></p>';
            }
        }
        echo '</table>';
    }

    public static function getBook($title) {
        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT book_title,author_name,
                                case when comments.book_id is not null then COUNT(*)
                                else 
                                0 
                                end as comments_count
                                FROM books
                                LEFT JOIN books_authors ON books_authors.book_id=books.book_id 
                                LEFT JOIN authors ON authors.author_id=books_authors.author_id 
                                left  JOIN comments ON books.book_id=comments.book_id
                                WHERE book_title=\'' . mysqli_real_escape_string($link, trim($title)) . '\'
                                GROUP BY  book_title,author_name');
        $sort = array();
        while ($value = mysqli_fetch_assoc($result)) {

            $sort[$value['book_title']]['title'] = $value['book_title'];
            $sort[$value['book_title']]['author'][] = $value['author_name'];
            $sort[$value['book_title']]['comments_count'] = $value['comments_count'];
        }

        echo '<table>
                <tr>';
        foreach ($sort as $val) {
            echo '<td style="color:white"><span class="glyphicon glyphicon-book"></span> ' . $val['title'] . '&nbsp&nbsp&nbsp</td><td>';

            foreach ($val['author'] as $value) {
                echo '<a href="books_by.php?id=' . $value . '" style="color:#999999">' . $value . '</a>&nbsp&nbsp';
            }
        }
        echo '</td></tr></table><br/>';
    }

}

?>
