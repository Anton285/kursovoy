<?php
$url = $_SERVER['REQUEST_URI'];
?>
<header class="light <?php if($_SESSION['theme']=="dark") {echo 'dark';}?>">
    <div class="container">
        <div class="header_wrapper">
            <div class="logo">
                <a href="/"><img src="Logo2.png"></a>
            </div>

            <div class="menu">
                <?php
                    echo "<a href=\"/pages/theme_toggle.php?url=$url\">Тема</a>"
                ?>
                <a href="/">Главная</a>
                <?php
                if (isset($_SESSION['auth'])) {
                    ?>
                    <a href="/pages/profile.php">Личный кабинет</a>
                    <a href="/pages/logout.php">Выйти</a>
                    <?php
                    if ($_SESSION['permissions'] == 'admin') {
                        ?>
                        <a href="/admin/index.php">Админ Панель</a>
                        <?php
                    }
                } else {
                    ?>
                    <a href="/pages/register.php">Регестрация</a>
                    <a href="/pages/login.php">Войти</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</header>