<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="1.css">
</head>

<body class="p-3">
  <?php

  include 'fun.php';
  include 'connect.php';


  $result = $mysqli->query('Select count(*) from gbook');
  $a = $result->fetch_array();
  $number = ceil($a[0] / $count); //колличество страниц
  $result = $mysqli->query("Select * From gbook Order by id DESC limit $_GET[p], $count");

  echo "<table border='2'>\n";
  echo "<hr>";
  echo "<td>№</td>";
  echo "<td>Text</td>";
  echo "<td>Name</td>";
  while ($row = $result->fetch_object()) {

    echo "<tr>";
    echo "<td>" .  $row->id . "</td>";
    echo "<td>" . bb_code(smile($row->text)) . "</td>";
    echo "<td>" . $row->name . "</td>";
    echo "</tr>";
  }
  echo "</table>\n";

  echo "<div class='mt-3'>";
  echo "<a href='index.php'>1</a>\t\n";
  for ($i = $count, $c = 2; $i < $a[0], $c <= $number; $i = $i + $count, $c++) {
    echo "<a href='page.php?p=$i&page=$c'>$c</a>\t\n";
  }
      echo "</div>";
  $result->free();

  $mysqli->close();
  ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>