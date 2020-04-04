<?php
    // print_r($_POST);
include 'connect.php';

    if (!empty($_POST['text']) && !empty($_POST['name'])) {

        $mysqli->query(
        "INSERT INTO `gbook` VALUES (null, '$_POST[text]', '$_POST[name]')"
        );
    }
   header('location:form.php');
    ?>
    
