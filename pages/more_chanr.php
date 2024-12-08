<?php
include "init.php";
?>



<!DOCTYPE html>
<html>
<head>
    <title>Kinoko</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/MoreStyle.css">
    <script src="assets/js/slider.js" defer></script>
</head>
<body>
<?php
include 'header.php';
?>
<main>
    <div class="container">
        <?php
            echo "<h2>{$_GET['genre']}</h2>";
        ?>
        <div class="items_wrapper">
            <?php
            $query = "SELECT * FROM films WHERE genre='{$_GET['genre']}'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

            foreach ($data as $film) {
                $genre = $film['genre'];
                $rating = round($film['rating'], 1);
                echo "
                                    <div class=\"item\">
                                    <img class='poster' src='/films/{$film['name']}/poster.png' width='300' height='169' alt=''>
                                    <div class='film_info'>
                                        <p>{$film['name']}</p>
                                        <div class='rating_film'>
                                            <p>$rating</p>
                                            <div class=\"star_film\"><img src=\"../assets/img/StarYellow.png\"></div>
                                        </div>
                                    </div>
                                    <a href=\"/pages/film.php?name={$film['name']}\"></a>
                                </div>";
            }
            ?>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>
</body>
</html>