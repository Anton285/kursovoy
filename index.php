<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'Kursovoy';

$link = mysqli_connect($host, $user, $password, $dbName);
mysqli_query($link, "SET NAMES 'utf8'");

session_start();
include 'pages/slider.php';
?>



<!DOCTYPE html>
<html>
<head>
    <title>Kinoko</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/darkstyle.css">
    <script src="assets/js/slider.js" defer></script>
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>" onload="ToggleTheme('<?php echo $_SESSION['theme'];?>')">
<?php
include 'pages/header.php';
?>
<main>
    <div class="container">

        <div class="slider">
            <img src="assets/img/Back.svg" class="back" onclick="ClickBack(this)" id="sb1" alt="">
            <div class="containedr">
                <div class="slide">
                    <h2 class="light_text <?php if($_SESSION['theme']=="dark") {echo 'dark_theme_text';}?>">Новые</h2>
                    <div class="items_wrapper" id="slider1">
                        <?php
                        $query = "SELECT * FROM films ORDER BY id DESC";
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

                        foreach ($data as $film) {
                            $genre = $film['genre'];
                            $rating = round($film['rating'], 1);
                            echo "
                                    <div class=\"item ";
                            if($_SESSION['theme']=="dark") {echo 'dark';}
                            echo "\">
                                    <img class='poster' src='films/{$film['name']}/poster.png' width='300' height='169' alt=''>
                                    <div class='film_info'>
                                        <p>{$film['name']}</p>
                                        <div class='rating_film'>
                                            <p>$rating</p>
                                            <div class=\"star_film\"><img src=\"../assets/img/StarYellow.png\"></div>
                                        </div>
                                    </div>
                                    <a href=\"pages/film.php?name={$film['name']}\" class='gd'></a>
                                </div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="wrapper_more">
                    <a href="/pages/more.php?name=Новые" class="more">Еще</a>
                </div>
            </div>
            <img src="assets/img/Forward.svg" class="forward" onclick="ClickForward(this)" id="sf1" alt="">
        </div>

        <div class="slider">
            <img src="assets/img/Back.svg" class="back" onclick="ClickBack(this)" id="sb2" alt="">
            <div class="containedr">
                <div class="slide">
                    <h2 class="light_text <?php if($_SESSION['theme']=="dark") {echo 'dark_theme_text';}?>">Популярные</h2>
                    <div class="items_wrapper" id="slider2">
                        <?php
                        $query = "SELECT * FROM films ORDER BY rating DESC";
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

                        foreach ($data as $film) {
                            $genre = $film['genre'];
                            $rating = round($film['rating'], 1);
                            echo "
                                    <div class=\"item ";
                            if($_SESSION['theme']=="dark") {echo 'dark';}
                            echo "\">
                                    <img class='poster' src='films/{$film['name']}/poster.png' width='300' height='169' alt=''>
                                    <div class='film_info'>
                                        <p>{$film['name']}</p>
                                        <div class='rating_film'>
                                            <p>$rating</p>
                                            <div class=\"star_film\"><img src=\"../assets/img/StarYellow.png\"></div>
                                        </div>
                                    </div>
                                    <a href=\"pages/film.php?name={$film['name']}\" class='gd'></a>
                                </div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="wrapper_more">
                    <a href="/pages/more.php?name=Популярные" class="more">Еще</a>
                </div>
            </div>
            <img src="assets/img/Forward.svg" class="forward" onclick="ClickForward(this)" id="sf2" alt="">
        </div>



        <div class="slider">
            <img src="assets/img/Back.svg" class="back" onclick="ClickBack(this)" id="sb3" alt="">
            <div class="containedr">
                <div class="slide">
                    <h2 class="light_text <?php if($_SESSION['theme']=="dark") {echo 'dark_theme_text';}?>">Жанры</h2>
                    <div class="items_wrapper" id="slider3">
                        <?php
                        $query = "SELECT * FROM genres";
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        for ($genres=[]; $row = mysqli_fetch_assoc($result); $genres[] = $row);
                        foreach ($genres as $genre) {
                            $query = "SELECT * FROM films WHERE genre='{$genre['genre']}'";
                            $result = mysqli_query($link, $query) or die(mysqli_error($link));
                               for ($films=[]; $row = mysqli_fetch_assoc($result); $films[] = $row);
                            echo " <div class=\"item ";
                            if($_SESSION['theme']=="dark") {echo 'dark';}
                            echo "\">
                                    <p class=\"chanr_name\">{$genre['genre']}</p>
                                <div class=\"img_chanr\">";
                            for ($i = 0; $i < 2; $i++) {
                                if (isset($films[$i])) {
                                    echo "<img class=\"empty_chanr\" src=\"/films/{$films[$i]['name']}/poster.png\" alt=''>";
                                } else {
                                    echo "<div class=\"empty_chanr\"></div>";
                                }
                            }
                            echo "</div>
                                    <div class=\"img_chanr\">";
                            for ($i = 2; $i < 4; $i++) {
                                if (isset($films[$i])) {
                                    echo "<img class=\"empty_chanr\" src=\"/films/{$films[$i]['name']}/poster.png\" alt=''>";
                                } else {
                                    echo "<div class=\"empty_chanr\"></div>";
                                }
                            }
                            echo "</div>
                                <a href=\"pages/more_chanr.php?genre={$genre['genre']}\" class='gd'></a>
                            </div>";

                        }
                        ?>
                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>



                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                            <div class="item">
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <div class="img_chanr">
                                    <div class="empty_chanr"></div>
                                    <div class="empty_chanr"></div>
                                </div>
                                <a href="#">Еще</a>
                            </div>

                    </div>
                </div>
            </div>
            <img src="assets/img/Forward.svg" class="forward" onclick="ClickForward(this)" id="sf3" alt="">
        </div>
    </div>
</main>

<?php
include 'pages/footer.php';
?>
</body>
</html>