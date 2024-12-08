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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/AdminStyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/darkstyle.css">
    <script src="../assets/js/dark_light_themes.js" defer></script>
	<title>Admin</title>
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>">
<?php
include '../pages/header.php';
?>
<main>
    <div class="container">
        <div class="add-film-form-wrapper">
            <div class="add-film-form <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
                <form enctype="multipart/form-data" method="POST">
                    <h2>Фильм</h2>
                    <div class="item_wrapper">
                        <div class="film-item">
                            <p>Название фильма</p>
                            <input type="text" name="name_film" required>
                        </div>
                        <div class="film-item">
                            <p>Описание фильма</p>
                            <textarea name="desc-film" required></textarea>
                        </div>
                        <div class="film-item">
                            <p>Постер фильма</p>
                            <input type="file" name="poster-film" accept="image/png, image/jpeg" required>
                        </div>
                        <div class="film-item">
                            <p>Фильм</p>
                            <input type="file" name="video-film" accept="video/*" required>
                        </div>
                        <div class="film-item">
                            <p>Жанр</p>
                            <select name="genres">
                                <?php
                                $query = "SELECT * FROM genres";
                                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                                for ($genres=[]; $row = mysqli_fetch_assoc($result); $genres[] = $row);
                                foreach ($genres as $genre) {
                                    echo "<option value=\"{$genre['genre']}\">{$genre['genre']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Добавить фильм">
                </form>
            </div>
        </div>
        <?php
        if(isset($_FILES)){ // Проверяем, загрузил ли пользователь файл
            if (isset($_POST['name_film'])) {
                $create_dir = "../films/{$_POST['name_film']}";
                if (!file_exists($create_dir)) {
                    mkdir($create_dir, 0700, true);
                    $destiation_dir_poster = "../films/{$_POST['name_film']}/".$_FILES['poster-film']['name'];
                    $destiation_dir_film = "../films/{$_POST['name_film']}/".$_FILES['video-film']['name'];// Директория для размещения файла
                    move_uploaded_file($_FILES['poster-film']['tmp_name'], $destiation_dir_poster );
                    move_uploaded_file($_FILES['video-film']['tmp_name'], $destiation_dir_film ); // Перемещаем файл в желаемую директорию
                    rename($destiation_dir_poster, "../films/{$_POST['name_film']}/poster.png");
                    rename($destiation_dir_film, "../films/{$_POST['name_film']}/film.mp4");
                    $desc_file = fopen("../films/{$_POST['name_film']}/desc.txt", "w") or die("Unable to open file!");
                    $desc = $_POST['desc-film'];
                    fwrite($desc_file, $desc);
                    fclose($desc_file);
                    $query = "INSERT INTO films SET name='{$_POST['name_film']}', rating='0.0', genre='{$_POST['genres']}'";
                    mysqli_query($link, $query);
                    echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
                } else {
                    echo 'Файл существует!';
                }
            } else {
                echo 'Заполните имя фильма';
            }
        }
        else{
            echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
        }
        ?>
        <div class="table_wrapper <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
            <h2>Пользователи</h2>
            <table class="users">
                <tr>
                    <th>Пользователь</th>
                    <th>Username</th>
                    <th>Права</th>
                    <th>Бан</th>
                </tr>
                <?php
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

                    foreach ($data as $page) {
                        echo "<tr>";
                        echo "<td>{$page['name']}</td>";
                        echo "<td>{$page['username']}</td>";
                        if ($page['permissions'] == 'user') {
                            echo "<td><a href=\"makeAdmin.php/?id={$page['id']}\">Сделать админом</a></td>";
                        } else {
                            echo "<td><a href=\"makeUser.php/?id={$page['id']}\">Сделать пользователем</a></td>";
                        }
                        if ($page['ban'] == '0') {
                            echo "<td><a href=\"ban.php/?id={$page['id']}\">Забанить</a></td>";
                        } else {
                            echo "<td><a href=\"unban.php/?id={$page['id']}\">Разбанить</a></td>";
                        }
                        echo "<td><a href=\"?delete={$page['id']}\">delete</a></td>";
                        echo "</tr>";
                     }
                ?>
            </table>
        </div>
    <div class="admin_feedbacks <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
        <h2>Отзывы</h2>
        <table>
            <tr>
                <th>Фильм</th>
                <th>Пользователь</th>
                <th>Отзыв</th>
                <th>Рейтинг</th>
                <th colspan="2">Разрешение</th>
            </tr>
            <?php
                $query = "SELECT * FROM feedbacks WHERE admined='0'";
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                for ($data=[]; $row = mysqli_fetch_assoc($result); $data[] = $row);

                foreach ($data as $feedback) {
                    echo "<tr>
                            <td>{$feedback['name_film']}</td>
                            <td>{$feedback['username']}</td>
                            <td>{$feedback['feedback']}</td>
                            <td>{$feedback['rating']}</td>
                            <td><a href=\"Correct.php?id={$feedback['id']}&film={$feedback['name_film']}\">Разрешить</a></td>
                            <td><a href=\"DeleteComment.php?id={$feedback['id']}\">Удалить</a></td>
                          </tr>";
                }
            ?>
        </table>
    </div>
    </div>
</main>
<?php
include '../pages/footer.php';
?>

</body>
</html>