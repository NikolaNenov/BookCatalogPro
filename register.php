<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'includes/header.php';
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
        <form method='POST' name='login' action='register.php'>
            <div  class="form-group"><input type='text' name='username' placeholder="Username" class="form-control" style="width: 200px"/></div>
            <div  class="form-group"><input type='password' name='password' placeholder="Password" class="form-control" style="width: 200px"/></div>
            <div><input type='submit' value='Register' class="btn btn-default" style="width: 200px"/></div>
        </form>  
        </p>
    </div>
</div>

<?php
if (isset($_SESSION['is_logged']) == 1) {
    header('location: index.php');
    exit();
}

if ($_POST) {
if (preg_match("/^[a-zA-Zа-яА-Я\ \-`\.]{3,30}$/u", $_POST['username']) === 1) {
    User::setUser();
}else{
    echo '<div class="alert alert-danger">Invalid chars!</div>';
}
}
include 'includes/footer.php';
