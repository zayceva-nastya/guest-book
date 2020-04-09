<?php
session_start();

// print_r($_POST);
include 'connect.php';
include 'fun.php';
if (!(isset($_SESSION['bantime']) && ($_SESSION['bantime'] > time()))){
    if (ban($_POST['text']) && !empty($_POST['name'])) {

        $mysqli->query(
            "INSERT INTO `gbook` VALUES (null, '$_POST[text]', '$_POST[name]')"
        );
    } else {
        $_SESSION['bantime'] = time() + 30;
    }
}
$_SESSION['time']=time();
file_put_contents("$_SESSION[time]","file.txt");
header('location:index.php');
