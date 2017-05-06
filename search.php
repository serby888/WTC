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
            header("location: index2.php?markSearch=2");
        exit; 
        }
      } 
      else
      { 
        header("location: index2.php?markSearch=1");
        exit; 
      } 
    } 

}

function table($result)
{
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         echo '<table border="1" cellpadding="5" style="border-collapse: collapse; text-align:center;" bgcolor="#f5f5f5">
         <col width="250">
         <col width="200">
         <col width="250">
         <col width="100">
         <tr><th> ФИО </a>
         </th><th>Телефонный номер</th><th>MAC-адрес</th></tr>';
        
        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 1 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>"; 
                    echo "<td><a href='view.php?id=".$row[0]."'style='color:blue;'>Просмотр</a></td>"; 
                    echo "<td><a href='edit.php?edd=".$row[0]."'style='color:blue;'>Редактировать</a></td>";
                    echo "<td><a href='index2.php?del=".$row[0]."' style='text-decoration: none;'><font size='5' color='red'>&#10006;</font></a></td>";
            echo "</tr>";
        } 
    echo "</table>";      
     
    // очищаем результат
    mysqli_free_result($result);
    }
}
?>
<br>
<form action='index2.php'>
<input type='submit' style='height:35px; width:300px' value='Вернуться на главную страницу'>
</form>