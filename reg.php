<html>
<head>
<title>Регистрация</title>
</head>
<body>
<h2>Регистрация</h2>
<form action="save_user.php" method="post">
<!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
  <p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
  </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** --> 
  <p>
    <label>Ваш пароль:<br></label>
    <input name="password2" type="password" size="15" maxlength="15">
  </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
<input type="submit" name="submit" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>

<?php
if(isset($_GET['error']) && $_GET['error'] == 1)
{
    echo "<script>alert(\"Ошибка! Вы не зарегистрированы\");
    document.location.href = 'reg.php';
    </script>";

}

if(isset($_GET['error']) && $_GET['error'] == 2)
{
    echo "<script>alert(\"Введённый логин уже зарегистрирован. Введите другой логин.\");
    document.location.href = 'reg.php';
    </script>";

}

if(isset($_GET['error']) && $_GET['error'] == 3)
{
    echo "<script>alert(\"Вы ввели не всю информацию - заполните все поля\");
    document.location.href = 'reg.php';
    </script>";

}

?>

</body>
</html>
