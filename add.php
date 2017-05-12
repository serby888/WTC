<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Добавление записи</title>
<link href="css/styleAdd.css" media="screen" rel="stylesheet">
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
<div id="region" align="center">
<?php
session_start();
require_once 'connection.php'; // подключаем скрипт 
   echo "
            <h2>Добавление записи</h2>
            <form action='add.php' method='post' name='form_add'>
                <input type='hidden' name='id_add' >Введите ФИО:<br>
                <input class='input' type='text' size='20' placeholder='Фамилия Имя Отчество' name='fio_add' ><br><br>Введите телефонный номер:<br>
                <input class='input' type='text' size='15' id='phone' name='number_add' placeholder='+375 (__) ___-__-__' ><br><br>Введите MAC-адрес:<br>
                <input class='input' type='text' size='15' id='mac' placeholder='__:__:__:__:__:__' name='mac_add' ><br><br>
                <input class='button' type='submit' value='Добавить'>
            </form>
            ";

if(!empty($_POST['fio_add']) AND !empty($_POST['number_add']) AND !empty($_POST['mac_add']))
{

    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

    $name = htmlentities(mysqli_real_escape_string($link, $_POST['fio_add']));
    $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8"); 

    if(preg_match('~[^а-яА-ЯёЁ ]~u', $name)) {
 
        echo "<div id='parent_popup'>
                    <div id='popup'>
                        <form action = 'add.php'>
                        <p> <input class='button' type='submit' style='float: right' value='Закрыть'></p>
                        <p>ФИО введено не корректно</p>
                </form>
            </div>
          </div>";
    }
    else{
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number_add']));

            $mac = htmlentities(mysqli_real_escape_string($link, $_POST['mac_add']));
            $mac = strtolower($mac);
            if (filter_var($mac, FILTER_VALIDATE_MAC))
            {
                $query2= "INSERT INTO table_user (FIO, Phone_number, MAC) VALUES('$name', '$number', '$mac')";
                mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                header("location: table.php");
                exit;
                mysqli_close($link);
            } 
            else 
            {
                echo "<div id='parent_popup'>
                    <div id='popup'>
                        <form action = 'add.php'>
                        <p> <input class='button' type='submit' style='float: right' value='Закрыть'></p>
                        <p>MAC-адрес введен не корректно</p>
                </form>
            </div>
          </div>";
            }
        }
}

?>
</div>
</body>
</html>
