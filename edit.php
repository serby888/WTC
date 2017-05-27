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
    $query1 = "SELECT * FROM table_user WHERE ID = '$_GET[edd]' AND GID = '".$_SESSION['id']."'" ;
    $result = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 

    $row = mysqli_fetch_array($result);
    echo "<h2>Редактирование записи</h2>
                <form action='edit.php?edd=".$row[0]."' method='post' name='form_edd'>
                    <input type='hidden' name='id_edd' value='".$row[0]."'>

                    Введите ФИО:<br>
                    <input class='input' type='text' size='15' name='fio_edd' value='".$row[1]."'><br><br>

                    Введите телефонный номер:<br>
                    <input class='input' type='text' size='15' id='phone' name='number_edd' value='".$row[2]."'><br><br>

                    Введите MAC-адрес:<br>
                    <input class='input' type='text' size='15' id='mac' name='mac_edd' value='".$row[3]."'><br><br>

                    <input class='button' type='submit' value='Сохранить'>
                </form>";
}
if(isset($_POST['fio_edd']) AND isset($_POST['number_edd']) AND isset($_POST['mac_edd']))
{
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

    $name = htmlentities(mysqli_real_escape_string($link, $_POST['fio_edd']));
    $name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8"); 

    if(preg_match('~[^а-яА-ЯёЁ ]~u', $name)) {
 
        echo "<div id='parent_popup'>
                <div id='popup'>
                  <form action='edit.php?edd=".$row[0]."' method='post'>
                    <p> <input class='button' type='submit' style='float: right' value='Закрыть'></p>
                    <p>ФИО введено не корректно</p>
                  </form>
                </div>
              </div>";
    }
    else{
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number_edd']));

                $mac = htmlentities(mysqli_real_escape_string($link, $_POST['mac_edd']));
                $mac = strtolower($mac);
                if (filter_var($mac, FILTER_VALIDATE_MAC))
                {
                        $query2= "UPDATE table_user SET FIO='$_POST[fio_edd]', Phone_number='$_POST[number_edd]', MAC='$_POST[mac_edd]' WHERE ID='$_POST[id_edd]' ";
                        mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
                        header("location: table.php");
                        exit;
                } 
                else 
                {
                    echo "<div id='parent_popup'>
                            <div id='popup'>
                                <form action='edit.php?edd=".$row[0]."' method='post'>
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
