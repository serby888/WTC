

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Результат поиска</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
</head>
<body>



<?php
session_start();
require_once 'connection.php';
$_GET['markSearch'] = 0;

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 

if(isset($_POST['submit']))
{ 

    if(isset($_GET['go']))
    { 

      if(!empty($_POST['query']))
      { 

        $name=$_POST['query']; 
        $sql="SELECT  * FROM table_user WHERE FIO LIKE '%" . $name .  "%'"; 
        $result1 = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
        $rows = mysqli_num_rows($result1); 
        table($result1);
        
        if ($rows == 0) 
        { 
            header("location: table.php?markSearch=2");
        exit; 
        }
      } 
      else
      { 
        header("location: table.php?markSearch=1");
        exit; 
      } 
    } 

}

function table($result)
{
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         echo '<table align= "center"  style=" text-align:center;" bgcolor="#ffffff">
                     <col width="300">
                     <col width="200">
                     <col width="200">
                     <col width="100">
                     <tr><th>ФИО</th>
                     <th>Телефонный номер</th>
                     <th>MAC-адрес</th></tr>';
        
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 1 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>"; 
                    echo "<td><a href='view.php?id=".$row[0]."'style='color:#9F693E; text-decoration: none;'>Просмотр</a></td>"; 
                    echo "<td><a href='edit.php?edd=".$row[0]."'style='color:#9F693E; text-decoration: none;'>Редактировать</a></td>";
                    echo "<td><a href='table.php?del=".$row[0]."' style='text-decoration: none;'><font size='5' color='#A11410'>&#10006;</font></a></td>";
            echo "</tr>";
        } 
    echo "</table>";      
     
    // очищаем результат
    mysqli_free_result($result);
    }
}
?>
<br>
    <form action='table.php'>
        <input class='button' type='submit' value='Вернуться на главную страницу'>
    </form>
</body>
</html>