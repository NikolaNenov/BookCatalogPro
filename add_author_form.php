<?php
include_once 'includes/header.php';
include_once 'Author.php';
include_once 'User.php';
?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <ul class="nav navbar-nav">
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-book"></span></a>
        <li><a href="index.php">Books</a></li>
        <li class="active"><a href="add_author_form.php"><span class="glyphicon glyphicon-plus"></span> Author</a></li>
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
        <form method = "POST" name = "author" action="add_author.php">
            <div class="form-group">
                <input type = "text" class="form-control" name = "name" placeholder = "Name" style="width:200px"/>
            </div>
            <div>    
                <input type = "submit"  class="btn btn-default" value = "Add" style="width:200px"/>
            </div>
        </form>
        </p>
        <table style="color:#999999">
            <tr><td style="border-bottom: 1px solid #999999"> </td><tr>
                <?php
                Author::printAllAuthors();
                ?>
        </table>    

    </div>
</div>
<?php
if (isset($_SESSION['error']) AND $_SESSION['error'] !== 0) {
    echo $_SESSION['error'];
    $_SESSION['error'] = 0;
}

include 'includes/footer.php';
