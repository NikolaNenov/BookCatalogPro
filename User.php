<?php

include_once 'DbConnection.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Nikola Nenov
 */
class User {

    private function __construct() {
        ;
    }

    public function setUser() {
        if (trim($_POST['username']) !== '' AND mb_strlen(trim($_POST['username'])) > 2 AND mb_strlen(trim($_POST['username'])) < 31) {
            $link = DbConnection::dbConnect();
            $result = $link->query('SELECT user_name FROM users WHERE user_name=\'' . mysqli_real_escape_string($link, trim($_POST['username'])) . '\'');
            if ($result->num_rows > 0) {
                echo '<div class="alert alert-danger">Username already exist!</div>';
            } elseif (trim($_POST['password']) !== '' AND mb_strlen(trim($_POST['password'])) > 2 AND mb_strlen(trim($_POST['password'])) < 30) {
                $result = $link->query('INSERT INTO users (user_name,user_pass) VALUE (\'' . mysqli_real_escape_string($link, trim($_POST['username'])) . '\',\'' . mysqli_real_escape_string($link, trim($_POST['password'])) . '\')');
                echo '<div class="alert alert-success">User registered successfull!</div>';
            } else {
                echo '<div class="alert alert-danger">Password must be between 3 and 30 chars!</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Username must be between 3 and 30 chars!</div>';
        }
    }

    public function loginUser() {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $link = DbConnection::dbConnect();
        $result = $link->query('SELECT * FROM users WHERE user_name=\'' . mysqli_real_escape_string($link, $username) . '\' AND user_pass=\'' . mysqli_real_escape_string($link, $password) . '\'');

        session_start();

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();
            $_SESSION['is_logged'] = 1;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_id'] = $row['user_id'];

            header('location: index.php');
            exit();
        } else {
            $_SESSION['error'] = '<div class="alert alert-danger">Invalid username or password!</div>';
            header('location: login_form.php');
            exit();
        }
    }

    public function logoutUser() {
        session_start();
        if (isset($_SESSION['is_logged']) == 1) {
            session_destroy();
        }
        header('location: index.php');
        exit();
    }

    public static function loginMenu() {

        echo '<ul class="nav navbar-nav navbar-right">';

        if (isset($_SESSION['is_logged']) == 1) {
            echo '<li><a href = "#"><b>Hello ' . $_SESSION['user_name'] . '!</b></a></li>
                   <li><a href = "logout.php"><span class="glyphicon glyphicon-remove"></span></a></li>';
        } else {
            echo '<li><a href = "login_form.php">Login</a></li>
                  <li><a href = "register.php">Register</a></li>';
        }
        echo '</ul>';
    }

}

?>
