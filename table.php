<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Таблица работников</title>
<link href="css/style.css" media="screen" rel="stylesheet">

</head>
<body>

<?php
session_start();
require_once 'connection.php'; // подключаем скрипт



$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM table_user WHERE GID = '".$_SESSION['id']."' ORDER BY FIO ASC";
 

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    table($result);


function table($result)
{
    if($result)
    {
        $rows = mysqli_num_rows($result); // количество полученных строк
         echo '<table align= "left"  style=" text-align:center;" bgcolor="#ffffff">
                     <col width="300">
                     <col width="200">
                     <col width="200">
                     <col width="100">
                     <tr><th>ФИО</th>
                     <th>Телефонный номер</th>
                     <th>MAC-адрес</th></tr>';

            echo "<div id = 'rectangle'><form action='/add.php'>
            <div id = 'butAdd'><input class = 'button2' type='submit' value='Добавить новую запись'> </div>
                </form>

                <form method='post' action='search.php?go'>
                    <div id = 'searAdd'>    
                        <input class='input' type='text' style='height:28px; width:250px;' name='query' placeholder='Поиск'>
                        <input class = 'button' type='submit' name='submit' value='Найти'> </div>
                </form>
                </div>
                <div id = 'rectangle1'><p>Ваш логин: <strong>".$_SESSION['login']."</strong></p>


                <form method='post' action='index.php'>
                    <input class = 'button3' type='submit' name='submit2' value='Выход'></div>
                </form><br><br>";

            

        for ($i = 0 ; $i < $rows ; ++$i)
        {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
                for ($j = 1 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>"; 
                    echo "<td><a href='view.php?id=".$row[0]."'style='color:#9F693E; text-decoration: none;'>Просмотр</a></td>"; 
                    echo "<td><a href='edit.php?edd=".$row[0]."'style='color:#9F693E; text-decoration: none;'>Редактировать</a></td>";
                    echo "<td><a href='table.php?del=".$row[0]."' style='text-decoration: none;'><font size='5' color='#8F1F1C'>&#10006;</font></a></td>";
            echo "</tr>";
        } 
    echo "</table>";      
     
    mysqli_free_result($result);
    }
}


if(isset($_GET['del']))
{

    $query3= "DELETE FROM table_user WHERE ID='$_GET[del]'";
    mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
    header("location: table.php");
    exit;
}

if(isset($_GET['markSearch']) && $_GET['markSearch'] == 1)
{
    echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'table.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>Ваш поисковой запрос пуст</p>
                </form>
            </div>
          </div>";
}



if(isset($_GET['markSearch']) && $_GET['markSearch'] == 2)
{
    echo "<div id='parent_popup'>
            <div id='popup'>
                <form action = 'table.php'>
                <p> <input class='button' type='submit' value='Закрыть'></p>
                <p>По Вашему поисковому запросу ничего не найдено</p>
                </form>
            </div>
          </div>";
}


mysqli_close($link);
?>
</body>
</html>
