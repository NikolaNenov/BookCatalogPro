<?php
include_once 'includes/header.php';
include_once 'User.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_SESSION['is_logged']) == 1) {
    header('location: index.php');
    exit();
}
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
    <ul class="nav navbar-nav" >
        <a class="navbar-brand" href="index.php" ><span class="glyphicon glyphicon-book"></span></a>
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
        <form method='POST' name='login' action='login.php'>
            <div  class="form-group"><input type='text' name='username' placeholder="Username" class="form-control" style="width: 200px"/></div>
            <div  class="form-group"><input type='password' name='password' placeholder="Password" class="form-control" style="width: 200px"/></div>
            <div><input type='submit' value='Login' class="btn btn-default" style="width: 200px"/></div>
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