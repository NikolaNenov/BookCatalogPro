<?php
include_once 'includes/header.php';
include_once 'Book.php';
include_once 'Author.php';
include_once 'User.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($_POST);
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <ul class="nav navbar-nav">
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-book"></span></a>
        <li><a href="index.php">Books</a></li>
        <li><a href="add_author_form.php"><span class="glyphicon glyphicon-plus"></span> Author</a></li>
        <li class="active"><a href="add_book_form.php"><span class="glyphicon glyphicon-plus"></span> Book</a></li>
    </ul>
    <?php
    User::loginMenu();
    ?>
</nav>

<br/>
<div class="jumbotron">
    <div class="container">
        <form method="POST" action="add_book.php" name="add book">
            <div class="form-group"><input type="text"  class="form-control" name="title" placeholder="Title" style="width:200px"/></div>

            <div class="form-group">
                <select multiple="multiple" name="selected_authors[]" class="form-control" style="width:200px">
                    <?php
                    Author::printAuthorsAsOptions();
                    ?>
                </select>
            </div>
            <div><input type="submit" value="Add" class="btn btn-default" style="width: 200px"/></div>
        </form>     

    </div>
</div>

<?php
if (isset($_SESSION['error']) AND $_SESSION['error'] !== 0) {
    echo $_SESSION['error'];
    $_SESSION['error'] = 0;
}

include 'includes/footer.php';