<?php
if (isset($_POST['login'])) 
{ 
	$login = $_POST['login']; 

	if ($login == '') 
	{ 
		unset($login);
	} 
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

if (isset($_POST['password2'])) 
{ 
	$password2 = $_POST['password2']; 
	if ($password2 == '') 
	{ 
		unset($password22);
	} 
}//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password2)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
	header("location: reg.php?error=3");
    exit; 
}
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password2 = stripslashes($password2);
$password2 = htmlspecialchars($password2);

//удаляем лишние пробелы
$login = trim($login);
$password2 = trim($password2);


 // подключаемся к базе
include ("connection.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
// проверка на существование пользователя с таким же логином
$result = mysqli_query($link, "SELECT id FROM users WHERE login='$login'");
$myrow = mysqli_fetch_array($result);

if (!empty($myrow['id'])) 
{

	header("location: reg.php?error=2");
    exit; 
}

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
// если такого нет, то сохраняем данные
$result2 = mysqli_query ($link, "INSERT INTO users (login, password) VALUES('" . $login . "','" . $password2 . "')") or die("Ошибки запроса: " . mysql_error());
// Проверяем, есть ли ошибки
if ($result2=='TRUE')
{
	header("location: index.php");
    exit;
}

else 
{
	header("location: reg.php?error=1");
    exit; 
}
?>