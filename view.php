<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.date_input.js"></script>
<script type="text/javascript">$($.date_input.initialize);</script>
<link rel="stylesheet" href="date_input.css" type="text/css">
</head>
<body>

<?php
require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT FIO, Phone_number, MAC FROM table_user WHERE ID = '$_GET[id]'";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $row = mysqli_fetch_row($result);
    echo "<h2>$row[0]</h2><br>
    <font size='4'>Телефонный номер: $row[1]</font><br>
    <font size='4'>MAC-адрес: $row[2]</font><br><br>";

    mysqli_free_result($result);
    
}
    echo "<form action='index.php'>
    <input type='submit' style='height:35px; width:300px' value='Вернуться на главную страницу'>
    </form>";
?>

<form action="#" method="post">
<p>
Вывести записи<br>
C: <input type="text" name="date" class="date_input">
По: <input type="text" name="date2" class="date_input">
<br><br><input type="submit" style="height:35px; width:167px" value="Фильтр">

<form action='view.php?id="$_GET[id]"'>
<input type="submit" style="height:35px; width:167px" value="Сброс">
</form>

</p>
</form>

<?php
if (!empty($_POST['date']) AND !empty($_POST['date2'])) {
    
    $value = $_POST['date'];
    $value = "$value 00:00:00.000000";

    $value2 = $_POST['date2'];
    $value2 = "$value2 00:00:00.000000";

    $queryTime = "SELECT * FROM table_time WHERE ((ID_phone = '$_GET[id]') AND (xTime >= '$value') AND (xTime <= '$value2'))" ;
    $result = mysqli_query($link, $queryTime) or die("Ошибка " . mysqli_error($link)); 

    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         echo '<table border="1" cellpadding="5" style="border-collapse: collapse;" bgcolor="#f5f5f5"><tr><th>Время</th><th>ID телефона</th></tr>
        <col width="199">
        <col width="101">';
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 1 ; $j < 3 ; ++$j) echo "<td>$row[$j]</a></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }
}
if (isset($_GET['id']) AND empty($_POST['date']) AND empty($_POST['date2']))
{

    $queryTime = "SELECT * FROM table_time WHERE ID_phone = '$_GET[id]'" ;
    $result = mysqli_query($link, $queryTime) or die("Ошибка " . mysqli_error($link)); 

    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         echo '<table border="1" cellpadding="5" style="border-collapse: collapse;" bgcolor="#f5f5f5"><tr><th>Время</th><th>ID телефона</th></tr>';
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 1 ; $j < 3 ; ++$j) echo "<td>$row[$j]</a></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }

}

?>



</body>
</html>
