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
<link href="style.css" media="screen" rel="stylesheet">
</head>
<body>

<div class="container mlogin">
<div id="login">

<h1>Вход</h1>
<form action="testreg.php" method="post">
<!--****  testreg.php - это адрес обработчика. То есть, после нажатия на кнопку  "Войти", данные из полей отправятся на страничку testreg.php методом  "post" ***** -->
  <p>
    <label>Ваш логин:<br></label>
    <input class="input" name="login" type="text" size="15" maxlength="15">
  </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
   <p>
    <label>Ваш пароль:<br></label>
    <input class="input" name="password3" type="password" size="15" maxlength="15">
  </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
<input class="button" type="submit" name="submit" value="Войти">
<!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** --> 
<!--**** ссылка на регистрацию, ведь как-то же должны гости туда попадать ***** -->
<a href="reg.php">Зарегистрироваться</a> 
</p></form>
<br>
</div></div>
<?php

if(isset($_GET['err']) && $_GET['err'] == 1)
{
    echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'index.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>Заполнены не все поля</p>
                </form>
            </div>
          </div>";
}

if(isset($_GET['err']) && $_GET['err'] == 2)
{
        echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'index.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>Неверный логин или пароль</p>
                </form>
            </div>
          </div>";
}

if(isset($_GET['err']) && $_GET['err'] == 3)
{
            echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'index.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>Неверный пароль</p>
                </form>
            </div>
          </div>";
}

?>
</body>
</html>
