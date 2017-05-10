<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.date_input.js"></script>
<script type="text/javascript">$($.date_input.initialize);</script>
<link rel="stylesheet" href="date_input.css" type="text/css">
    <title>Просмотр записи</title>
    <link href="style2.css" media="screen" rel="stylesheet">
</head>
<body>
<div id="region" align="center">
<?php
session_start();
require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT FIO, Phone_number, MAC FROM table_user WHERE ID = '$_GET[id]'";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $row = mysqli_fetch_row($result);
    echo "<div id='rectangle'>
            <h2>$row[0]</h2>
            <font size='4'>Телефонный номер: $row[1]</font>
            <font size='4'>MAC-адрес: $row[2]</font>
        </div>";

    mysqli_free_result($result);
    
}

?>
<div >
<form action="#" method="post">
<p>
<font size="4">Вывести записи</font><br><br>
C: <input  type="text" name="date" class="date_input input">
По: <input  type="text" name="date2" class="date_input input">
<br><br><input class="button2" type="submit" style="height:35px; width:167px" value="Фильтр">

    <form action='view.php?id="$_GET[id]"'>
    <input class="button3" type="submit" style="height:35px; width:167px" value="Сброс">
    </form>
</p>
</form>
</div>
<?php
if (!empty($_POST['date']) AND !empty($_POST['date2'])) {
    
    $value = $_POST['date'];
    $value = "$value 00:00:00.000000";

    $value2 = $_POST['date2'];
    $value2 = "$value2 00:00:00.000000";

    $queryTime = "SELECT xTime FROM table_time WHERE ((ID_phone = '$_GET[id]') AND (xTime >= '$value') AND (xTime <= '$value2'))" ;
    $result = mysqli_query($link, $queryTime) or die("Ошибка " . mysqli_error($link)); 
    timeControl($result);

}
if (isset($_GET['id']) AND empty($_POST['date']) AND empty($_POST['date2']))
{

    $yesterday  = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));  
    $tomorrow  = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+1, date("Y"))); 

    $queryTime = "SELECT xTime FROM table_time WHERE ID_phone = '$_GET[id]' AND (xTime >= '$yesterday') AND (xTime <= '$tomorrow')" ;
    $result = mysqli_query($link, $queryTime) or die("Ошибка " . mysqli_error($link)); 
    timeControl($result);
    
}


function timeControl($result)
{
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
        echo '<br><table align= "center" border="1" cellpadding="5" style="border-collapse: collapse; text-align:center;" bgcolor="#f5f5f5"><tr><th>Время</th></tr>
        <col width="199">';

        $row = mysqli_fetch_row($result); 
        $timeFirst = $row[0];
        $date = date_create("$timeFirst");
        echo "<tr>";
        echo "<td>$row[0]</a></td>"; 
        echo "</tr>";

        for ($i = 0 ; $i < $rows-1 ; ++$i)
        {
            date_add($date, date_interval_create_from_date_string('30 minutes'));

            $row = mysqli_fetch_row($result);
            $time = $row[0];
            $date1 = date_create("$time");
            $b = 1;  
            if($date < $date1)  //echo date_format($date, 'Y-m-d H:i:s');
            {
                echo "<tr>";
                echo "<td><font color='red'>$timeFirst</font></td>"; 
                echo "</tr>";
                echo "<tr>";
                echo "<td><font color='red'>$row[0]</font></td>"; 
                echo "</tr>";
                $b = 0;
            }

            $timeFirst=$time;
            $date = $date1;
        }
        if($b == 1)
        {
            echo "<tr>";
            echo "<td>$row[0]</a></td>"; 
            echo "</tr>";
        }
           
    }
        echo "</table><br>";
}


    echo "</div><form action='index2.php'>
    <input class='button1' type='submit' value='Вернуться на главную страницу'>
    </form>";
?>



</body>
</html>
