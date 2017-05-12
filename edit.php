<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Редактирование записи</title>
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

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
if(isset($_GET['edd']) != 0)
{
    $query1 = "SELECT * FROM table_user WHERE ID = '$_GET[edd]'" ;
    $result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 

    $row = mysqli_fetch_array($result);
    echo "<h2>Редактирование записи</h2>
                <form action='edit.php' method='post' name='form_edd'>
                    <input type='hidden' name='id_edd' value='".$row[0]."'>Введите ФИО:<br>
                    <input class='input' type='text' size='15' name='fio_edd' value='".$row[1]."'><br><br>Введите телефонный номер:<br>
                    <input class='input' type='text' size='15' id='phone' name='number_edd' value='".$row[2]."'><br><br>Введите MAC-адрес:<br>
                    <input class='input' type='text' size='15' id='mac' name='mac_edd' value='".$row[3]."'><br><br>
                    <input class='button' type='submit' value='Сохранить'>
                </form>";
}
if(isset($_POST['fio_edd']) AND isset($_POST['number_edd']) AND isset($_POST['mac_edd']))
{

    $query2= "UPDATE table_user SET FIO='$_POST[fio_edd]', Phone_number='$_POST[number_edd]', MAC='$_POST[mac_edd]' WHERE ID='$_POST[id_edd]'";
    mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
    header("location: table.php");
    exit;
}
?>
</div>
</body>
</html>
