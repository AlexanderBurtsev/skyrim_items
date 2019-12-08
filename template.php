<?php
preg_match('~<h1.*?>(.*?)<\/h1>~u', $response, $title);
$title = $title[1];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $title; ?></title>
    <meta charset='utf-8'>
    <link rel='stylesheet' href="style.css">
</head>
<body>
    <?php
    require_once 'nav.html';
    ?>
    <h2><?= $title; ?></h2>
    <form id='items' method='POST'>
        <ul>
            <?php
            foreach ($items as $key => $value) {
                echo "<li>";
                echo "<input type='checkbox' id='{$value[0]}' name='{$value[0]}[check]'> ";
                echo "<label for='{$value[0]}'><img class='img' src='{$value[1]}'>";
                echo "<span>{$key}</span></label><input class='count' type='text' name='{$value[0]}[count]'>";
                echo "</li>";
            }
            ?>
        </ul>
        <br>
        
        <div class='fixed'>
            <input id='rewrite' type='checkbox' name='rewrite'>
            <label for='rewrite'>Перезаписать</label>
            <input class='submit add' type='submit' value='Добавить'>
        </div>
    </form>
    
    <?php
    require_once 'handler.php';
    ?>
</body>
</html>