<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'includes/header.php';
include_once 'Book.php';
include_once 'Comment.php';
include_once 'DbConnection.php';
include_once 'User.php';
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <ul class="nav navbar-nav">
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-book"></span></a>
        <li><a href="index.php">Books</a></li>
        <li><a href="add_author_form.php"><span class="glyphicon glyphicon-plus"></span> Author</a></li>
        <li><a href="add_book_form.php"><span class="glyphicon glyphicon-plus"></span> Book</a></li>
    </ul>
    <?php
    User::loginMenu();
    ?>
</nav>
<br/>
<br/>
<div class="jumbotron">
    <div class="container">
        <?php
        if (isset($_SESSION['is_logged']) == 1) {

            echo '<div>
            <a href = "add_comment_form.php?id=' . $_GET['id'] . '">
            <button class = "btn btn-default" value = "Регистрирай" style = "width: 200px">Add comment</button>
            </a></div>
            <br/>';
        }

        if (isset($_GET['id'])) {
            Book::getBook($_GET['id']);
            Comment::getComments($_GET['id']);
        } else {
            header('location: index.php');
            exit();
        }
        ?>

    </div>
</div>

<?php
include 'includes/footer.php';


