<?php
    include 'init.php';

    if (isset($_POST['login']) and isset($_POST['password']) and isset($_POST['password_confirm']) and isset($_POST['username'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $username = $_POST['username'];
        $reg_date_t = mktime(0, 0, 0, date("m")+1, date("d"),   date("Y"));
        $reg_date = date('d.m.Y', $reg_date_t);

        if ($password == $password_confirm) {
            $query = "SELECT * FROM users WHERE name='$login'";
		    $result = mysqli_query($link, $query) or die(mysqli_error($link));
		    $user = mysqli_fetch_assoc($result);
            if (empty($user)) {
                $query = "INSERT INTO users SET name='$login', password='$password', permissions='user', username='$username', pay_date='$reg_date', ban='0'";
                mysqli_query($link, $query);
                $_SESSION['auth'] = true;
                $_SESSION['username'] = $username;
                header("Location: http://kursovoy/index.php");
            } else {
                $_SESSION['error'] = 'Пользователь с таким логином уже есть';
            }
        } else {
            $_SESSION['error'] = 'Пароль не подтвержен';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/RegisterStyle.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/darkstyle.css">
</head>
<body class="<?php if($_SESSION['theme']=="dark") {echo 'dark_body';}?>">
<?php
include 'header.php';
?>

<main>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='error'>{$_SESSION['error']}</div>";
    }
    ?>
    <form class="register_block <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>" method="POST">
        <h2>Регистрация</h2>
        <div class="form_wrapper">
            <div class="form_item">
                <h3>Логин</h3>
                <input class="form_input" type="text" name="login" >
            </div>
            <div class="form_item">
                <h3>Имя пользователя</h3>
                <input class="form_input" type="text" name="username" >
            </div>
            <div class="form_item">
                <h3>Пароль</h3>
                <input class="form_input" type="password" name="password" >
            </div>
            <div class="form_item">
                <h3>Подтвердите пароль</h3>
                <input class="form_input" type="password" name="password_confirm" >
            </div>
            <input class="form_btn" type="submit" name="submit" value="Зарегистрироваться">
        </div>
    </form>
</main>

<?php
include 'footer.php';
?>
</body>
</html>