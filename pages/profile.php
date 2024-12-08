<?php
include "init.php";
$query = "SELECT * FROM users WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$user = mysqli_fetch_assoc($result);
if (!isset($_SESSION['auth'])) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kinoko</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/ProfileStyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/darkstyle.css">
    <script src="../assets/js/dark_light_themes.js" defer></script>
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>">
<?php
include "header.php";
?>
<main>
    <div class="container">
        <div class="profile_block <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
            <h2>Личный профиль</h2>
            <div class="info_wrapper">
                <div class="profile_item_user">
                    <?php
                     echo "<h3>{$_SESSION['username']}</h3>";
                    ?>
                </div>
                <div class="profile_item_sub">
                    <h3>Стоимость подписки:</h3>
                    <h3>300 руб/мес</h3>
                </div>
                <div class="profile_item_pay">
                    <h3>Дата списания:</h3>
                    <?php
                    echo "<h3>{$user['pay_date']}</h3>";
                    ?>
                </div>
            </div>
        </div>

        <div class="reviews_block <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
            <h2>Мои отзывы</h2>
            <div class="reviews_wrapper">
                <?php
                $query = "SELECT * FROM feedbacks WHERE username='{$_SESSION['username']}'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                if (!empty($result)) {
                    for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);
                    foreach ($data as $feedback) {
                        if ($feedback['admined'] == '1') {
                            ?>
                <div class="review_item">
                    <hr>
                    <div class="header_review">
                        <?php
                        echo "<div class=\"name_film\">{$feedback['name_film']}</div>";
                        ?>
                        <div class="stars">
                            <?php
                            echo "<h2>{$feedback['rating']}</h2>";
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $feedback['rating']) {
                                    echo "<div class=\"star\"><img src=\"../assets/img/StarYellow.png\"></div>";
                                } else {
                                    echo "<div class=\"star\"><img src=\"../assets/img/StarBlack.png\"></div>";
                                }
                            }
                            ?>
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
    </div>
</main>

<?php
include "footer.php";
?>
</body>
</html>