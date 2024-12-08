<?php
    include '../pages/init.php';

    if (isset($_POST['password_admin']) and isset($_POST['login_admin'])) {
		$login = $_POST['login_admin'];
		
		$query = "SELECT * FROM users WHERE name='$login'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$user = mysqli_fetch_assoc($result);
		if (!empty($user)) {
			$DB_password = $user['password'];
			$permissions = $user['permissions'];
			if ($_POST['password_admin'] == $DB_password) {
				if ($permissions == 'admin') {
					$_SESSION['adminUser'] = true;
                    $_SESSION['auth'] = true;
                    header("Location: http://kursovoy2/admin/index.php");
				}
			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/LoginStyle.css">
	<title>Admin</title>
</head>
<body>
<?php
include '../pages/header.php';
?>
<main>
    <form class="login_block" method="POST">
        <h2>Войти в Админ панель</h2>
        <div class="form_wrapper">
            <div class="form_item">
                <h3>Логин</h3>
                <input class="form_input" type="text" name="login_admin" >
            </div>
            <div class="form_item">
                <h3>Пароль</h3>
                <input class="form_input" type="password" name="password_admin" >
            </div>
            <input class="form_btn" type="submit"  value="Войти">
        </div>
    </form>
</main>
<?php
include '../pages/footer.php';
?>
</body>
</html>