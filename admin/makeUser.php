<?php
    include '../pages/init.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pay_date_t = mktime(0, 0, 0, date("m")+1, date("d"),   date("Y"));
        $pay_date = date('d.m.Y', $pay_date_t);
        $query = "UPDATE users SET permissions='user', pay_date='$pay_date' WHERE id=$id";
        mysqli_query($link, $query);
        header("Location: http://kursovoy2/admin/index.php");
    }