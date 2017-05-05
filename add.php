<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
</head>
<body>

<script type="text/javascript">
jQuery(function($){
   $("#phone").mask("+375 (99) 999-99-99");
   $("#mac").mask("**:**:**:**:**:**");
});
</script>

<?php

require_once 'connection.php'; // подключаем скрипт 
   echo "<h2>Добавление записи</h2><form action='add.php' method='post' name='form_add'>
    <input type='hidden' name='id_add' '>Введите ФИО:<br>
    <input type='text' size='30' placeholder='Фамилия Имя Отчество' name='fio_add' ><br><br>Введите телефонный номер:<br>
    <input type='text' id='phone' name='number_add' placeholder='+375 (__) ___-__-__' ><br><br>Введите MAC-адрес:<br>
    <input type='text' id='mac' placeholder='__:__:__:__:__:__' name='mac_add' ><br><br>
    <input type='submit' value='Добавить'>
    </form>";

if(!empty($_POST['fio_add']) AND !empty($_POST['number_add']) AND !empty($_POST['mac_add']))
{

    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

    $name = htmlentities(mysqli_real_escape_string($link, $_POST['fio_add']));
    $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8"); 

    if(preg_match('~[^а-яА-ЯёЁ ]~u', $name)) {
        echo "<br><font color='red'>ФИО введено не корректно</font>";
    }
    else{
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number_add']));

            $mac = htmlentities(mysqli_real_escape_string($link, $_POST['mac_add']));
            $mac = strtolower($mac);
            if (filter_var($mac, FILTER_VALIDATE_MAC))
            {
                $query2= "INSERT INTO table_user (FIO, Phone_number, MAC) VALUES('$name', '$number', '$mac')";
                mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                header("location: index.php");
                exit;
                mysqli_close($link);
            } 
            else 
            {
                echo "<br><font color='red'>MAC-адрес введен не корректно</font>";
            }
        }
}

?>
</body>
</html>
