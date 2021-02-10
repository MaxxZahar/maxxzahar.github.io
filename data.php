<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Database</title>
  <link rel="stylesheet" href="data.css" />
</head>

<body>
  <header>
    Database
  </header>
  <div class="container">
    <?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
      header("Location: needtorl.php");
      exit;
    }
    $UserID = $_SESSION['id'];
    $UserID = strval($UserID);
    $db = 'host1823062';
    $user = 'host1823062';
    $pass = 'Ny0B9MXAEm';
    $db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
    $res = $db->query('SELECT * FROM `datahands` WHERE UserID = "' . $UserID . '"');
    if (!$res) { //если ошибка - убиваем процесс и выводим сообщение об ошибке.
      die(htmlspecialchars($db->error));
    }
    while ($table = mysqli_fetch_row($res)) {
      $Deal = $table[2];
      $Bids = $table[3];
      $Bids = str_replace('s', '&spades;', $Bids);
      $Bids = str_replace('c', '&clubs;', $Bids);
      $Bids = str_replace('de', 'z', $Bids);
      $Bids = str_replace('d', '&diams;', $Bids);
      $Bids = str_replace('z', 'de', $Bids);
      $Bids = str_replace('h', '&hearts;', $Bids);
      $Bids = str_replace('nt', 'NT', $Bids);
      $Bids = str_replace(';', '; ', $Bids);
      $Bids = str_replace('T', 'T ', $Bids);
      echo "<div class='record'>";
      echo "<div class='deal' data-handrecord ='" . $table[2] . "'></div>";
      echo "<div><span class='line bids' data-bids = '" . $Bids . "'></span><br><span class='line comments'>" . $table[4] . "</span>" . '<br>' . "<span class='line date'>" . $table[5] . "</span></div>";
      echo "<form action='create.php' method='get'>";
      echo "<input type='text' name='deal' class='full' value='" . $Deal . "'>";
      echo "<button type='submit' class='button' name='createbutton' value='create'>Load</button>";
      echo '</form>';
      echo "</div>";
      #"<span class='line deal'>" . $table[2] . "</span>" . "<br>" . 
      // . '<br>' . "<span class='line comments'>" . $table[4] . "</span>" . '<br>' . "<span class='line date'>" . $table[5] . "</span>" . '<br>
    }
    $db->close();
    ob_end_flush();
    ?>
  </div>
  <script src="handtoimage.js"></script>
</body>

</html>