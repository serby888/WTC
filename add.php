<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>


<?php

require_once 'connection.php'; // подключаем скрипт 
   echo "<h2>Добавление записи</h2><form action='add.php' method='post' name='form_add'>
    <input type='hidden' name='id_add' '>Введите ФИО:<br>
    <input type='text' size='30' name='fio_add' ><br><br>Введите телефонный номер:<br>
    <input type='text' name='number_add' ><br><br>Введите MAC-адрес:<br>
    <input type='text' name='mac_add' ><br><br>
    <input type='submit' value='Добавить'>
    </form>";

if(!empty($_POST['fio_add']) AND !empty($_POST['number_add']) AND !empty($_POST['mac_add']))
{

    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

    $name = htmlentities(mysqli_real_escape_string($link, $_POST['fio_add']));

    if(preg_match('~[^а-яА-ЯёЁ ]~u', $name)) {
        echo "<br><font color='red'>ФИО введено не корректно</font>";
    }
    else{
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number_add']));
                     $mac = htmlentities(mysqli_real_escape_string($link, $_POST['mac_add']));

                    $query2= "INSERT INTO table_user (FIO, Phone_number, MAC) VALUES('$name', '$number', '$mac')";
                    mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                    header("location: index.php");
                    exit;
                    mysqli_close($link);
        }
}

?>
</body>
</html>
