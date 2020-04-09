<?php
session_start();


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <style>
        img {

            width: 1rem;

        }

        .pageination a {
            color: green;
        }

        .selectedpage {
            color: red !important;
            font-weight: bold;
        }
        .ban{
            border: 2px solid red;
            color: red;
            font-size: 5rem;
            font-weight: bold;
            transform: rotate(-25deg);
            position: absolute;
            top:30%;
            left:20%;
            padding: 10px;
        }
    </style>
</head>

<body class="p-3">
<?php

include 'fun.php';
include 'connect.php';

// print_r($_SESSION);
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
  
}
// echo "Время первого посещения:\n". date("m.d.y H:i:s", $_SESSION['time'])."<br>";


if (isset($_SESSION['time'])) {
    $time=(time()-$_SESSION['time']);
}
echo "Вы находитесь на этой странице\n".$time."s"." <br>";

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
}
echo "Колличество посещений:\n" . $_SESSION['counter']++ . "<br>";
// echo sys_get_temp_dir() ;



$result_count = $mysqli->query("SELECT count(*) FROM gbook"); //считаем количество строк в таблице

$count = $result_count->fetch_array(MYSQLI_NUM)[0];
echo "количество записей: <b>$count</b><br>";
$result_count->free();

// echo $pagesize;

$pagecount = ceil($count / $pagesize);

$currientpage = $_GET['page'] ?? 1;
$startrow = ($currientpage - 1) * $pagesize;

$pageination = "<div class='pageination'>";

for ($i = 1; $i <= $pagecount; $i++) {

    $str = ($currientpage == $i) ? " class='selectedpage'" : "";
    $pageination .= "<a href='?page=$i'$str>$i</a>";
}

$result = $mysqli->query("SELECT * FROM gbook LIMIT $startrow, $pagesize");
echo "<br>";
echo "<table border='1'>\n";

while ($row = $result->fetch_object()) {
    echo "<tr>";
    echo "<td>" . cens(smile($row->text)) . "</td>";
    echo "<td>" . $row->name . "</td>";
    echo "</tr>";
}
echo "</table>\n<br>";

echo $pageination;
if (isset($_SESSION['bantime']) && ($_SESSION['bantime'] > time())) {
    
    echo "<div class='ban'>Вы забанены на\n" . ($_SESSION['bantime'] - time()) . "\nc</div>";
}

$result->free();
$mysqli->close();

?>
    <form action="gb.php" method="POST">

        <textarea name="text" cols="30" rows="10"></textarea><br>

        <input type="text" name="name"><br>

        <button type="submit">отправить</button>

    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
