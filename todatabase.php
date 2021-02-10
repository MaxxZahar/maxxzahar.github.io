<?php
  session_start();
  ob_start();
  if (!isset($_SESSION['loggedin'])) {
    header("Location: needtorl.php");
    exit;
  }
  if(isset($_POST['datasavebutton'])){
      date_default_timezone_set('Europe/Moscow');
      $Instant = date("Y-m-d");
      $Deal = $_POST['deal'];
      $Bids = $_POST['bids'];
      $Comments = $_POST['comments'];
      $UserID = $_SESSION['id'];
      #$Logged = $_SESSION['name'];
      #$Logged = $Logged.'_table';
      $Bids = trim(preg_replace('/\s+/','',$Bids));
      $file = fopen("data.txt","w+");
      $entity = $Deal."\n".$Bids."\n".$Comments."\n".$Instant."\n";
      flock($file, LOCK_EX);
      fwrite($file, $entity);
      flock($file,LOCK_UN);
      rewind($file);
      fclose($file);
      
      $user = 'host1823062';
      $pass = 'Ny0B9MXAEm';
      $db = 'host1823062';
      $db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
      $Deal = $db->real_escape_string($Deal);
      $Bids = $db->real_escape_string($Bids);
      $Comments = $db->real_escape_string($Comments);
      #$Logged = $db->real_escape_string($Logged);
      /*$query1 = 'CREATE TABLE IF NOT EXISTS `Try2` (
        ID INT AUTO_INCREMENT,
        Hand VARCHAR(100) NOT NULL,
        Bids VARCHAR(255),
        Comment TEXT,
        Date DATE,
        PRIMARY KEY(ID),
        UNIQUE(Hand)
      )';
      $res = $db->prepare($query1);
      if( ! $res ){ //если ошибка - убиваем процесс и выводим сообщение об ошибке.
        die( htmlspecialchars($db->error) );
      }
      $res->bind_param("s", $Logged);
      $res->execute();
      $db->query($query1);*/
      $query = 'INSERT INTO `datahands` VALUES ("", ?, ?, ?, ?, ?)';
      #$res = $db->query('INSERT INTO `hands` VALUES ("", $Deal, $Bids, $Comments, $Instant)');
      #$res = $db->query('SELECT * FROM `hands`');
      $res = $db->prepare($query);
      $res->bind_param("issss", $UserID, $Deal, $Bids, $Comments, $Instant);
      $res->execute();
      #$res = $db->query('SELECT * FROM `hands`');
      #while($table = mysqli_fetch_row($res)){
      #echo $table[1] . " <br> " . $table[2] . ' <br> ' . $table[3] . ' <br> ' . $table[4] . '<br><br>';
      #}
      $db->close();
      header("Location: data.php");
      #header("Content-Disposition: attachment; filename=\"" . basename($path) . "\"");
      #header("Content-type: text/x-pbn; charset=ISO-8859-1");
      
      exit;
  }
  ob_end_flush();
  exit;
?>