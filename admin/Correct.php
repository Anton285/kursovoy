<?php

include '../pages/init.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $film = $_GET['film'];
    $query = "UPDATE feedbacks SET admined=1 WHERE id=$id";
    mysqli_query($link, $query);
    $query = "SELECT AVG(rating) FROM feedbacks WHERE name_film='$film' AND admined='1'";
    $resultSQL = mysqli_query($link, $query);
    $result = mysqli_fetch_array($resultSQL);
    $query = "UPDATE films SET rating={$result['AVG(rating)']} WHERE name='$film'";
    mysqli_query($link, $query);
    header("Location: http://kursovoy2/admin/index.php");
}
