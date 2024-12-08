<?php
function GetSlider($link, $query, $name_slide)
{
    echo "<div class=\"slider\">
            <img src=\"assets/img/Back.svg\" class=\"back\" onclick=\"ClickBack(this)\" id=\"sb1\">
            <div class=\"containedr\">
                <div class=\"slide\">
                    <h2>$name_slide</h2>
                    <div class=\"items_wrapper\" id=\"slider1\">";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;

    foreach ($data as $film) {
        echo "
                                    <div class=\"item\">
                                    <img class='poster' src='films/{$film['name']}/poster.png' width='197' height='320'>
                                    <p>{$film['name']}</p>
                                    <a href=\"pages/film.php?name={$film['name']}\">Смотреть</a>
                                </div>";
    }
    echo '
                    </div>
                </div>
                <div class="wrapper_more">
                    <a href="#" class="more">Еще</a>
                </div>
            </div>
            <img src="assets/img/Forward.svg" class="forward" onclick="ClickForward(this)" id="sf1">
        </div>';
}
?>