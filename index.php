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

<body class="px-3">
  <?php
  include 'fun.php';
  include 'connect.php';

  $mysqli = new mysqli(
    'remotemysql.com',
    'R9rH7eFGck',
    'a4YE3DiL5g',
    'R9rH7eFGck'
);

  $result = $mysqli->query('Select count(*) from gbook');
  $a = $result->fetch_array();


  $count = 20; // колличество записей на странице

  $number = ceil($a[0] / $count); //колличество страниц


  if (!empty($_POST['text']) && !empty($_POST['name'])) {

    $mysqli->query(
    "INSERT INTO `gbook` VALUES (null, '$_POST[text]', '$_POST[name]')"
    );
}

  echo "<br>";

  if (!$_GET) {
    $result = $mysqli->query("Select * From gbook Order by id DESC limit  $count");

    echo "Эта таблица содержит\t" . $a[0] . "\tстрок<br>";

    while ($row = $result->fetch_object()) {
      echo "<div class='d-inline border mr-2 w-10'>" . $row->id .
        "</div>" . "<b>" . bb_code(smile($row->text)) .
        " </b><i>" . $row->name . "</i><br>\n";
    }

    echo "<a href='index.php'>1</a>\t\n";
    for ($i = 20, $c = 2; $i < $a[0],$c<=$number; $i = $i + $count, $c++) {

      echo "<a href='index.php?p=$i'>$c</a>\t";
    }
  } else {
       $result = $mysqli->query("Select * From gbook Order by id DESC limit $_GET[p], $count");

    while ($row = $result->fetch_object()) {

      echo "<div class='d-inline border mr-2 w-auto '>" . $row->id .
        "</div>" . "<b>" . bb_code(smile($row->text)) .
        " </b><i>\n" . $row->name . "</i><br>\n";
    }
    echo "<a href='index.php'>1</a>\t\n";
    for ($i = $count, $c = 2; $i < $a[0],$c<=$number; $i = $i + $count, $c++) {
      echo "<a href='index.php?p=$i'>$c</a>\t\n";
    }
  }


  $result->free();

  $mysqli->close();
  ?>
  <br>
  <form action="?" method="post">
    <textarea name="text"></textarea>
    <input type="text" name="name">
    <input type="submit">
  </form>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
