<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<style>
    body{
        background-image: url(124.jpg);
    }
</style>

<?php
require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
if(isset($_GET['edd']) != 0)
{
    $query1 = "SELECT * FROM table_user WHERE ID = '$_GET[edd]'" ;
    $result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 

    $row = mysqli_fetch_array($result);
    echo "<h2>Редактирование записи</h2><form action='edit.php' method='post' name='form_edd'>
    <input type='hidden' name='id_edd' value='".$row[0]."'>Введите ФИО:<br>
    <input type='text' size='30' name='fio_edd' value='".$row[1]."'><br><br>Введите телефонный номер:<br>
    <input type='text' name='number_edd' value='".$row[2]."'><br><br>Введите MAC-адрес:<br>
    <input type='text' name='mac_edd' value='".$row[3]."'><br><br>
    <input type='submit' value='Сохранить'>
    </form>";
}
if(isset($_POST['fio_edd']) AND isset($_POST['number_edd']) AND isset($_POST['mac_edd']))
{

    $query2= "UPDATE table_user SET ФИО='$_POST[fio_edd]', Мобильный='$_POST[number_edd]', MAC='$_POST[mac_edd]' WHERE ID='$_POST[id_edd]'";
    mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
    header("location: index.php");
    exit;
}
?>
</body>
</html>
