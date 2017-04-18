<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>


<?php
require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM table_user";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     echo '<table border="1" cellpadding="5" style="border-collapse: collapse; text-align:center;" bgcolor="#f5f5f5">
     <col width="250">
     <col width="200">
     <col width="250">
     <col width="100">
     <tr><th>ФИО</th><th>Телефонный номер</th><th>MAC-адрес</th></tr>';
    echo "<form action='/add.php'>
    <input type='submit' style='height:35px; width:250px' value='Добавить новую запись'>
    </form><br><br>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 1 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>"; 
                echo "<td><a href='view.php?id=".$row[0]."'style='color:blue;'>Просмотр</a></td>"; 
                echo "<td><a href='edit.php?edd=".$row[0]."'style='color:blue;'>Редактировать</a></td>";
                echo "<td><a href='index.php?del=".$row[0]."' style='text-decoration: none;'><font size='5' color='red'>&#10006;</font></a></td>";
        echo "</tr>";
    } 
    echo "</table>";      
     
    // очищаем результат
    mysqli_free_result($result);
    
}
    if(isset($_GET['del']))
{

    $query3= "DELETE FROM table_user WHERE ID='$_GET[del]'";
    mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
    header("location: index.php");
    exit;
}
mysqli_close($link);
?>
</body>
</html>
