<?php
session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password3'])) { $password3=$_POST['password3']; if ($password3 =='') { unset($password3);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password3)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
  header("location: index.php?err=1");
  exit;
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password3 = stripslashes($password3);
$password3 = htmlspecialchars($password3);

//удаляем лишние пробелы
$login = trim($login);
$password3 = trim($password3);


// подключаемся к базе
include ("connection.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 


$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
// проверка на существование пользователя с таким же логином
$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password']))
{
//если пользователя с введенным логином не существует
header("location: index.php?err=2");
exit;
}
else {
//если существует, то сверяем пароли
          if ($myrow['password']==$password3) {
          //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
          $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
          header("location: index2.php");
          exit;
          }

       else {
       //если пароли не сошлись
       header("location: index.php?err=3");
       exit;
	   }
}
?>