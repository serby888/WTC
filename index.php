<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
    if(isset($_POST['submit2']))
    {
        session_destroy();
        header("location:index.php");
    }

?>
<html>
<head>
<title>Вход в учетную запись</title>
</head>
<body>
<h2>Вход в учетную запись</h2>
<form action="testreg.php" method="post">
<!--****  testreg.php - это адрес обработчика. То есть, после нажатия на кнопку  "Войти", данные из полей отправятся на страничку testreg.php методом  "post" ***** -->
  <p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
 
    <label>Ваш пароль:<br></label>
    <input name="password3" type="password" size="15" maxlength="15">
  </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
<input type="submit" name="submit" value="Войти">
<!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** --> 
<br>
<!--**** ссылка на регистрацию, ведь как-то же должны гости туда попадать ***** -->
<a href="reg.php">Зарегистрироваться</a> 
</p></form>
<br>
<?php

if(isset($_GET['err']) && $_GET['err'] == 1)
{
    echo "<script>alert(\"Одно из полей не заполено \");
    document.location.href = 'index.php';
    </script>";

}

if(isset($_GET['err']) && $_GET['err'] == 2)
{
    echo "<script>alert(\"Неверный логин или пароль \");
    document.location.href = 'index.php';
    </script>";

}

if(isset($_GET['err']) && $_GET['err'] == 3)
{
    echo "<script>alert(\"Неверный пароль \");
    document.location.href = 'index.php';
    </script>";

}

?>
</body>
</html>
