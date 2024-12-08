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
    <title>Kinoko</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/FilmStyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/darkstyle.css">
    <script src="/assets/js/star.js" defer></script>
    <script src="/assets/js/dark_light_themes.js" defer></script>
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>">
<?php
include 'header.php';
?>
<?php
if (isset($_GET['name'])) {
?>
<main>
    <div class="container">
        <div class="blocks_wrapper">
            <div class="block_left">
                <div class="film_wrapper">

                        <div class="film <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
                            <?php

                            if (isset($_SESSION['auth'])) {
                            echo "<video controls class=\"empty_film\">
                    <source src=\"../films/{$_GET['name']}/film.mp4\" type=\"video/mp4\" />
                    Download the
                    <a href=\"../films/{$_GET['name']}/film.mp4\">MP4</a>
            </video>";
                            } else {
                                echo "<video controls class=\"empty_film\">
                    <source src=\"../films/{$_GET['name']}/trailer.mp4\" type=\"video/mp4\" />
                    Download the
                    <a href=\"../films/{$_GET['name']}/trailer.mp4\">MP4</a>
            </video></h2>";
                            }
                            ?>
                        </div>
                </div>

                <div class="desc_film <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
                    <?php
                        echo "<h2>{$_GET['name']}</h2>";
                        $text = file_get_contents("../films/{$_GET['name']}/desc.txt");
                        echo $text;

                    ?>
                </div>
            <?php
            }
            ?>
                <div class="reviews <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
                    <h2>Отзывы:</h2>
                    <div class="menu_review">
                        <div class="stars_wrapper">
                            <div class="reviews_stars">
                                <?php
                                $query = "SELECT * FROM films WHERE name='{$_GET['name']}'";
                                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                                $film = mysqli_fetch_assoc($result);
                                $genre = $film['genre'];
                                $rating = round($film['rating'], 1);
                                 echo "<h2>$rating</h2>";
                                ?>
                                <div class="stars">
                                    <?php
                                    $b = -0.5;
                                        for ($i = 0; $i < 5; $i++) {
                                            echo "<div class=\"star\">";
                                            $b += 0.5;
                                            if ($b < $rating) {
                                                echo "<img src=\"../assets/img/StarYellowLeft.png\">";
                                            } else {
                                                echo "<img src=\"../assets/img/StarBlackLeft.png\">";
                                            }
                                            $b += 0.5;
                                            if ($b < $rating) {
                                                echo "<img src=\"../assets/img/StarYellowRight.png\">";
                                            } else {
                                                echo "<img src=\"../assets/img/StarBlackRight.png\">";
                                            }
                                            echo "</div>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="wrapper_counters">
                                <div class="wrapper_counter">
                                    <p>5</p>
                                    <div class="counter_bg">
                                        <div class="counter" id="c1"></div>
                                    </div>
                                </div>

                                <div class="wrapper_counter">
                                    <p>4</p>
                                    <div class="counter_bg">
                                        <div class="counter" id="c2"></div>
                                    </div>
                                </div>

                                <div class="wrapper_counter">
                                    <p>3</p>
                                    <div class="counter_bg">
                                        <div class="counter" id="c3"></div>
                                    </div>
                                </div>

                                <div class="wrapper_counter">
                                    <p>2</p>
                                    <div class="counter_bg">
                                        <div class="counter" id="c4"></div>
                                    </div>
                                </div>

                                <div class="wrapper_counter">
                                    <p>1</p>
                                    <div class="counter_bg">
                                        <div class="counter" id="c5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_SESSION['auth'])) {
                        ?>
                        <form class="write_review_wrapper" method="POST">
                            <textarea class="write_review" placeholder="Есть что рассказать об этом фильме?" name="feedback_film"></textarea>
                            <div class="rating_radio">
                                <h2 id="rat_star">5</h2>
                                <div class="star_feedback">
                                    <input type="radio" name="feedback_rating" id="star_1" value="1">
                                    <label for="star_1"><img src="/assets/img/StarBlack.png" class="star_black" id="black1" width="30" height="30"></label>
                                    <label for="star_1"><img src="/assets/img/StarYellow.png" class="star_yellow" id="yellow1" width="30" height="30"></label>
                                </div>
                                <div class="star_feedback">
                                    <input type="radio" name="feedback_rating" id="star_2" value="2">
                                    <label for="star_2"><img src="/assets/img/StarBlack.png" class="star_black" id="black2" width="30" height="30"></label>
                                    <label for="star_2"><img src="/assets/img/StarYellow.png" class="star_yellow" id="yellow2" width="30" height="30"></label>
                                </div>
                                <div class="star_feedback">
                                    <input type="radio" name="feedback_rating" id="star_3" value="3">
                                    <label for="star_3"><img src="/assets/img/StarBlack.png" class="star_black" id="black3" width="30" height="30"></label>
                                    <label for="star_3"><img src="/assets/img/StarYellow.png" class="star_yellow" id="yellow3" width="30" height="30"></label>
                                </div>
                                <div class="star_feedback">
                                    <input type="radio" name="feedback_rating" id="star_4" value="4">
                                    <label for="star_4"><img src="/assets/img/StarBlack.png" class="star_black" id="black4" width="30" height="30"></label>
                                    <label for="star_4"><img src="/assets/img/StarYellow.png" class="star_yellow" id="yellow4" width="30" height="30"></label>
                                </div>
                                <div class="star_feedback">
                                    <input type="radio" name="feedback_rating" id="star_5" value="5" checked>
                                    <label for="star_5"><img src="/assets/img/StarBlack.png" class="star_black" id="black5" width="30" height="30"></label>
                                    <label for="star_5"><img src="/assets/img/StarYellow.png" class="star_yellow" id="yellow5" width="30" height="30"></label>
                                </div>
                            </div>
                            <input type="submit" value="Отправить отзыв">
                        </form>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    $query = "SELECT * FROM feedbacks WHERE name_film='{$_GET['name']}'";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    if (!empty($result)) {
                        for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);
                        foreach ($data as $feedback) {
                            if ($feedback['admined'] == '1') {
                    ?>
                    <div class="review">
                        <hr>
                        <div class="head_review">
                            <div class="user">
                                <?php
                                 echo "<h3>{$feedback['username']}</h3>"
                                ?>
                            </div>

                            <div class="review_stars">
                                <?php
                                echo "<h2>{$feedback['rating']}</h2>";
                                ?>
                                <div class="stars">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $feedback['rating']) {
                                            echo "<div class=\"star_review\"><img src=\"../assets/img/StarYellow.png\"></div>";
                                        } else {
                                            echo "<div class=\"star_review\"><img src=\"../assets/img/StarBlack.png\"></div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            echo "<p>{$feedback['feedback']}</p>";
                        ?>
                    </div>
                    <?php
                            }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="block_right">
                <h2 class="light_text <?php if($_SESSION['theme']=="dark") {echo 'dark_theme_text';}?>">Рекомендуем вам еще: </h2>

                <?php
                $query = "SELECT * FROM films WHERE genre='$genre'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

                foreach ($data as $film) {
                    if ($film['name'] !== $_GET['name']) {
                        $genre = $film['genre'];
                        $rating = round($film['rating'], 1);
                        echo "
                                    <div class=\"item ";
                if ($_SESSION['theme'] == "dark") {
                    echo 'dark';
                }
                echo "\">
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
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php
$query = "SELECT rating FROM feedbacks WHERE name_film='{$_GET['name']}' AND admined='1'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($ratings=[]; $row = mysqli_fetch_assoc($result); $ratings[] = $row);
$count_rating = count($ratings);
if (empty($ratings)) {
    $stars = [0,0,0,0,0];
} else {
    foreach ($ratings as $key => $rating) {
        $stars[] = $rating['rating'];
    }
}
$count_ratings = array_count_values($stars);
if (isset($count_ratings['5'])) {
    $count_five = $count_ratings['5'];
} else {
    $count_five = 0;
}
if (isset($count_ratings['4'])) {
    $count_four = $count_ratings['4'];
} else {
    $count_four = 0;
}
if (isset($count_ratings['3'])) {
    $count_three = $count_ratings['3'];
} else {
    $count_three = 0;
}
if (isset($count_ratings['2'])) {
    $count_two = $count_ratings['2'];
} else {
    $count_two = 0;
}
if (isset($count_ratings['1'])) {
    $count_one = $count_ratings['1'];
} else {
    $count_one = 0;
}
?>
<script>
    var CountRatings = "<?php echo $count_rating ?>";
    var ArrCountRatings = ["<?php echo $count_five ?>", "<?php echo $count_four ?>", "<?php echo $count_three ?>", "<?php echo $count_two ?>","<?php echo $count_one ?>"];
    let RatioRatings = [];
    for (let i = 0; i < 5; i++) {
        RatioRatings[i] = ArrCountRatings[i] / CountRatings * 100;
    }
    for (let i = 0; i<5; i++){
        let id_ratio = 'c' + (i+1);
        console.log(id_ratio);
        document.getElementById(id_ratio).style.width = RatioRatings[i] + '%';

    }
</script>
<?php
include 'footer.php';
?>
</body>
</html>