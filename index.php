<?php
if (isset($_COOKIE['guest']))
{
	echo "Вы авторизовались, как ".$_COOKIE['guest'];
} 
?>
<!DOCTYPE html>
<html>
<head>
<title>Куки, сессии и сокеты</title>
<meta charset="utf-8">
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
	<h1>Домашнее задание к лекции 2.4 «Куки, сессии и авторизация»</h1>
</header>

<?php
if (!isset($_COOKIE['guest'])) 
	if (strlen($_POST['guest'] > 0)) 
		{
			setcookie('guest',$_POST['guest'],time()+60*60*24*30);echo "куки создали";
		}
?>
<?
if ((isset($_POST['username']))&&(isset($_POST['password'])))
    {

        $json_text = file_get_contents("login.json");
        $obj = json_decode($json_text); // Преобразуем JSON строку в объект
        #var_dump($obj);
        if($obj == NULL)
        {
            echo("Ошибка при получении данных о работнике");
            exit;
        }
        $i = 0;
        $y = count($obj);
        $auth = false;
        while ($i < $y) 
            {
	        if (($_POST['username'] == $obj[$i]->login) && ($_POST['password'] == $obj[$i]->password))
	        	$auth = true;
	        $i ++;
	        }
	    if ($auth == true) {
	    	echo "Доброго времени суток \"".$_POST['username']."\"";
	    	echo "Вы вошли на сайт как \"".$_POST['username']."\".<br>";
            echo "<h2>Список тестов:</h2>";
	    }

    }
?>
<?
if ((isset($_POST['guest']))&&(strlen($_POST['guest']) > 0))
    {

$json_text = file_get_contents("test.json");
$obj = json_decode($json_text); // Преобразуем JSON строку в объект
#var_dump($obj);
if($obj == NULL)
{
    echo("Ошибка при получении данных о работнике");
    exit;
}
$i = 0;
$y = count($obj);
echo "Вы вошли на сайт как \"".$_POST['guest']."\".<br>";
echo "<h2>Список тестов:</h2>";
echo "<ul>";
while ($i < $y) {echo "<li>";echo "<a href=test.php?id=$i>";echo $obj[$i]->test."</a></li>";$i ++;}
echo "</ul>";
}
?>
<form method="post" action="index.php">
<table>
<tr>
    <td>
	<b>Введи ваш логин</b>
	</td>
	<td>
    <input type="text" name="username" value="">
    </td>
</tr>
<tr>
    <td>
    <b>Введи ваш пароль</b>
    </td>
    <td>
    <input type="text" name="password" value="">
    </td>
</tr>
<tr>
<td colspan="2" align="center">
    <button name="submit">Вход</button>
</td>
</tr>
</table>
</form>
<br>

<table>
<?php 
if (!isset($_COOKIE['guest']))
{
	echo <<<php
<form method="post" action="index.php">
<tr><td>
    <input type="text" name="guest" value="">
    </td>
    <td>
    <button name="submit">Войти как гость</button>
    </td>
</tr>
</form>
php;
}else 
{
echo "Вы авторизовались, как ".$_COOKIE['guest'];
echo "<a href=delete_cookie.php> Выйти </a>";
}
?>
</table>

<footer>
	<p>Copyright. Все права защищены</p>
</footer>
</body>

</html>