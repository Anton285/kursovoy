<?php
    include 'init.php';

    if (isset($_POST['feedback_film']) and !empty($_POST['feedback_film']) and isset($_POST['feedback_rating'])) {
        $query = "INSERT INTO feedbacks SET name_film='{$_GET['name']}', username='{$_SESSION['username']}', rating='{$_POST['feedback_rating']}', feedback='{$_POST['feedback_film']}', admined='0'";
        mysqli_query($link, $query);
        header("Location: /pages/film.php?name={$_GET['name']}");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Фильм</title>
</head>
<body>
<?php
    if (isset($_GET['name'])) {
?>
    <div class="poster">
        <?php
            echo "<img src=\"../films/{$_GET['name']}/poster.png\" width=\"300\">";
        ?>
    </div>
    <div class="description">
        <?php
        $text = file_get_contents("../films/{$_GET['name']}/desc.txt");
        echo $text;
        ?>
    </div>
    <div class="film">
        <?php
            echo "<video controls width=\"250\">
                    <source src=\"../films/{$_GET['name']}/film.mp4\" type=\"video/mp4\" />
                    Download the
                    <a href=\"../films/{$_GET['name']}/film.mp4\">MP4</a>
            </video>";
        ?>
    </div>
<?php
    }
?>
    <div class="feedbacks_wrapper">
        <?php
            if (isset($_SESSION['auth'])) {
        ?>
                    <div class="form_feed_wrapper">
                        <form method="POST">
                            <input type="text" name="feedback_film" placeholder="Напишите отзыв о фильме">
                            <input type="range" name="feedback_rating" min="1" max="5">
                            <input type='submit'>
                        </form>
                    </div>
        <?php
            }
        ?>
        <div class="feedbacks">
            <?php
            $query = "SELECT * FROM feedbacks WHERE name_film='{$_GET['name']}'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            if (!empty($result)) {
            ?>
                <div class="feedback">
                    <?php
                    for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);
                    foreach ($data as $feedback) {
                        if ($feedback['admined'] == '1') {
                            echo "<p>{$feedback['feedback']}</p>";
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

