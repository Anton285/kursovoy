<?php
    include '../pages/init.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "UPDATE users SET ban=1 WHERE id=$id";
        mysqli_query($link, $query);
        header("Location: http://kursovoy2/admin/index.php");
    }