<?php
include_once 'includes/header.php';
include_once 'Book.php';
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
        <p>
            <?php
            if (isset($_GET['id'])) {
                Book::printAllBooksBy($_GET['id']);
            } else {
                header('location: index.php');
                exit();
            }
            ?>    
        </p>
    </div>
</div>
<?php
include 'includes/footer.php';
