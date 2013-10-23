<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'includes/header.php';
include_once 'User.php';
include_once 'Comment.php';

$_SESSION['source_url'] = $_SERVER['HTTP_REFERER'];
$_SESSION['book_title'] = $_GET['id'];
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
        <p>
        <form method="POST" name="comment box" action="add_comment.php">
            <div  class="form-group"><textarea name="comment" rows="5" class="form-control" style="width: 250px"></textarea></div>
            <div  class="form-group"><input type="submit" value="Add comment" name="ok" class="btn btn-default" style="width: 250px"></div>
        </form> 
        </p>
    </div>
</div>



<?php
if (isset($_SESSION['error']) AND $_SESSION['error'] !== 0) {
    echo $_SESSION['error'];
    $_SESSION['error'] = 0;
}

include 'includes/footer.php';