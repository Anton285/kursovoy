<?php
    include 'init.php';

    if (isset($_POST['login_user']) and isset($_POST['password_user'])) {
        $login = $_POST['login_user'];
		
		$query = "SELECT * FROM users WHERE name='$login'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$user = mysqli_fetch_assoc($result);
        if (!empty($user)) {
            $DB_password = $user['password'];
			if ($_POST['password_user'] == $DB_password) {
                if ($user['ban'] == "1")
                {
                    echo "<script>alert(\"Вы забанены\")</script>";
                } else {
                    $_SESSION['auth'] = true;
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['permissions'] = $user['permissions'];
                    header('Location: ../index.php');
                }
			} else {
                echo "<script>alert(\"Неверный логин или пароль\")</script>";
            }
        } else {
            echo "<script>alert(\"Такого пользователя не существует\")</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/LoginStyle.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/darkstyle.css">
	<title>Войти</title>
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>">
<?php
include 'header.php';
?>
<main>
    <form class="login_block <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>" method="POST">
        <h2>Войти</h2>
        <div class="form_wrapper">
            <div class="form_item">
                <h3>Логин</h3>
                <input class="form_input" type="text" name="login_user" >
            </div>
            <div class="form_item">
                <h3>Пароль</h3>
                <input class="form_input" type="password" name="password_user" >
            </div>
            <input class="form_btn" type="submit" name="submit" value="Войти">
        </div>
    </form>
</main>
    <?php
    include 'footer.php';
    ?>
</body>
</html>