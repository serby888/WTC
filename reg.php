<html>
<head>
<title>Регистрация</title>
<link href="style.css" media="screen" rel="stylesheet">
</head>
<body>
<div class="container mlogin">
<div id="login">
<h1>Регистрация</h1>
<form action="save_user.php" method="post">
<!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
  <p>
    <label>Ваш логин:<br></label>
    <input class="input" name="login" type="text" size="15" maxlength="15">
  </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** --> 
  <p>
    <label>Ваш пароль:<br></label>
    <input class="input" name="password2" type="password" size="15" maxlength="15">
  </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
<input class="button" type="submit" name="submit" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>
</div></div>
<?php
if(isset($_GET['error']) && $_GET['error'] == 1)
{
    echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'reg.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>Ошибка! Вы не зарегистрированы</p>
                </form>
            </div>
          </div>";
}

if(isset($_GET['error']) && $_GET['error'] == 2)
{
	echo "<div id='parent_popup'>
	            <div id='popup'>
	                <form action = 'reg.php'>
	                <p> <input class='button' type='submit' value='Закрыть'></p>
	                <p>Введённый логин уже зарегистрирован. Введите другой логин</p>
	                </form>
	            </div>
	          </div>";
}

if(isset($_GET['error']) && $_GET['error'] == 3)
{
	echo "<div id='parent_popup'>
	            <div id='popup'>
	                <form action = 'reg.php'>
	                <p> <input class='button' type='submit' value='Закрыть'></p>
	                <p>Вы ввели не всю информацию. <br>Заполните все поля</p>
	                </form>
	            </div>
	          </div>";
}

?>

</body>
</html>
