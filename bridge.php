<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MaZaBridge</title>
  <link rel="stylesheet" href="style.css" />

</head>

<body>
  <header>
    MaZaBridge
  </header>

  <?php
  echo "<div class='regform_container'>";
  echo "<div class='lrforms'>";
  echo "<form action='register.php' method='post' autocomplete='off'>";
  echo "<input type='text' name='login' class='regform' placeholder='username' required>";
  echo "<input type='text' name='password' class='regform' placeholder='password' required>";
  echo "<button type='submit' class='button' name='registerbutton' value='register'>Register</button>";
  echo "</form>";
  echo "<form action='login.php' method='post' autocomplete='off'>";
  echo "<input type='text' name='login' class='regform' placeholder='username' required>";
  echo "<input type='text' name='password' class='regform' placeholder='password' required>";
  echo "<button type='submit' class='button' name='loginbutton' value='login'>Login</button>";
  echo "</form>";
  echo "</div>";
  echo "</div>";
  ?>
  <?php
  session_start();
  if (isset($_SESSION['loggedin'])) {
    echo '<script type="text/JavaScript">  
     document.querySelector(".regform_container").style.display = "none"; 
     </script>';
  }
  ?>
  <?php
  ini_set('error_log', 'C:\xampp\htdocs\test\err.txt');
  ini_set('log_errors', 'On');
  $Suits = ['C', 'D', 'H', 'S'];
  $Values = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];
  foreach ($Suits as $suit) {
    foreach ($Values as $value) {
      $Deck[] = $suit . $value;
    }
  }
  function hcp($Hand)
  {
    $HCP = 0;
    foreach ($Hand as $card) {
      if ($card[1] == 'A') {
        $HCP += 4;
      }
      if ($card[1] == 'K') {
        $HCP += 3;
      }
      if ($card[1] == 'Q') {
        $HCP += 2;
      }
      if ($card[1] == 'J') {
        $HCP += 1;
      }
    }
    return $HCP;
  }
  function distribution($Hand)
  {
    $clubs = 0;
    $diamonds = 0;
    $hearts = 0;
    $spades = 0;
    foreach ($Hand as $card) {
      switch ($card[0]) {
        case "C":
          $clubs++;
          break;
        case "D":
          $diamonds++;
          break;
        case "H":
          $hearts++;
          break;
        case "S":
          $spades++;
          break;
      }
    }
    $distribution = compact('clubs', 'diamonds', 'hearts', 'spades');
    return $distribution;
  }
  function is_balanced($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[0] == 4 && $distribution[3] != 1) {
      return true;
    }
    if ($distribution[0] == 5 && $distribution[1] == 3) {
      return true;
    }
    return false;
  }
  function is_semibalanced($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if (!is_balanced($Hand) && $distribution[3] > 1) {
      return true;
    }
    return false;
  }
  function is_unbalanced($Hand)
  {
    if (!is_balanced($Hand) && !is_semibalanced($Hand)) {
      return true;
    }
    return false;
  }
  function two_suited($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[0] > 4 && $distribution[1] > 3) {
      return true;
    }
    return false;
  }
  function one_suited($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[0] > 5 && $distribution[1] < 4) {
      return true;
    }
    return false;
  }
  function three_suited($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[2] > 3) {
      return true;
    }
    return false;
  }
  function is_single($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[3] == 1) {
      return true;
    }
    return false;
  }
  function is_void($Hand)
  {
    $distribution = array_values(distribution($Hand));
    rsort($distribution);
    if ($distribution[3] == 0) {
      return true;
    }
    return false;
  }

  function generator($Deck, $mode = 1)
  {
    shuffle($Deck);
    if ($mode == 1) {
      return $Deck;
    }
    if ($mode == 2) {
      $Hand1 = array();
      for ($i = 0; $i < 13; $i++) {
        $Hand1[] = $Deck[$i];
      }
      $HCP = hcp($Hand1);
      $distribution = distribution($Hand1);
      if ($HCP > 4 && $HCP < 11 && loss_counter($Hand1) < 9 && (two_suited($Hand1) || one_suited($Hand1))) {
        return $Deck;
      } else {
        return generator($Deck, $mode);
      }
    }
    if ($mode == 3) {
      $Hand1 = array();
      for ($i = 0; $i < 13; $i++) {
        $Hand1[] = $Deck[$i];
      }
      $HCP = hcp($Hand1);
      $distribution = distribution($Hand1);
      if ($HCP > 14 && $HCP < 18 && is_balanced($Hand1)) {
        return $Deck;
      } else {
        return generator($Deck, $mode);
      }
    }
    if ($mode == 4) {
      $Hand1 = array();
      for ($i = 0; $i < 13; $i++) {
        $Hand1[] = $Deck[$i];
      }
      $HCP = hcp($Hand1);
      $distribution = distribution($Hand1);
      if (($HCP > 22 && is_balanced($Hand1)) || ($HCP > 15 && one_suited($Hand1) && loss_counter($Hand1) < 5) || ($HCP > 15 && two_suited($Hand1) && loss_counter($Hand1) < 4)) {
        return $Deck;
      } else {
        return generator($Deck, $mode);
      }
    }
    if ($mode == 0) {
      $Hand1 = array();
      for ($i = 0; $i < 13; $i++) {
        $Hand1[] = $Deck[$i];
      }
      $HCP = hcp($Hand1);
      $distribution = distribution($Hand1);
      $min = $_POST['minhcp'];
      $max = $_POST['maxhcp'];
      if (isset($_POST['handtype'])) {
        $Checker = [is_balanced($Hand1), is_semibalanced($Hand1), is_unbalanced($Hand1), one_suited($Hand1), two_suited($Hand1), three_suited($Hand1), is_single($Hand1), is_void($Hand1)];
        $Conditions = $_POST['handtype'];
        if ($HCP > ($min - 1) && $HCP < ($max + 1)) {
          foreach ($Conditions as $condition) {
            if (!$Checker[$condition]) {
              return generator($Deck, $mode);
            }
          }
          return $Deck;
        } else {
          return generator($Deck, $mode);
        }
      } else {
        if ($HCP > ($min - 1) && $HCP < ($max + 1)) {
          return $Deck;
        } else {
          return generator($Deck, $mode);
        }
      }
    }
  }
  if (isset($_POST['filterbutton'])) {
    $mode = $_POST['filter'];
    $Deck = generator($Deck, $mode);
    $min = 0;
    $max = 27;
  } elseif (isset($_POST['customizebutton'])) {
    $min = $_POST['minhcp'];
    $max = $_POST['maxhcp'];
    $mode = 0;
    $Deck = generator($Deck, $mode);
  } else {
    $min = 0;
    $max = 27;
    $Deck = generator($Deck);
  }

  $Hand1 = array_slice($Deck, 0, 13); #North
  $Hand2 = array_slice($Deck, 13, 13); #South
  $Hand3 = array_slice($Deck, 26, 13); #East
  $Hand4 = array_slice($Deck, 39, 13); #West

  #PBN order: South => West => North => East

  function f_sort($Hand1, $Hand2)
  {
    if ($Hand1[0] > $Hand2[0]) return 1;
    if ($Hand1[0] < $Hand2[0]) return -1;
    if ($Hand1[0] == $Hand2[0]) {
      if ($Hand1[1] == "T" && $Hand2[1] == "J") return -1;
      if ($Hand1[1] == "T" && $Hand2[1] == "Q") return -1;
      if ($Hand1[1] == "T" && $Hand2[1] == "K") return -1;
      if ($Hand1[1] == "T" && $Hand2[1] == "A") return -1;
      if ($Hand1[1] == "J" && $Hand2[1] == "T") return 1;
      if ($Hand1[1] == "J" && $Hand2[1] == "Q") return -1;
      if ($Hand1[1] == "J" && $Hand2[1] == "K") return -1;
      if ($Hand1[1] == "J" && $Hand2[1] == "A") return -1;
      if ($Hand1[1] == "Q" && $Hand2[1] == "T") return 1;
      if ($Hand1[1] == "Q" && $Hand2[1] == "J") return 1;
      if ($Hand1[1] == "Q" && $Hand2[1] == "K") return -1;
      if ($Hand1[1] == "Q" && $Hand2[1] == "A") return -1;
      if ($Hand1[1] == "K" && $Hand2[1] == "T") return 1;
      if ($Hand1[1] == "K" && $Hand2[1] == "J") return 1;
      if ($Hand1[1] == "K" && $Hand2[1] == "Q") return 1;
      if ($Hand1[1] == "K" && $Hand2[1] == "A") return -1;
      if ($Hand1[1] == "A" && $Hand2[1] == "T") return 1;
      if ($Hand1[1] == "A" && $Hand2[1] == "J") return 1;
      if ($Hand1[1] == "A" && $Hand2[1] == "Q") return 1;
      if ($Hand1[1] == "A" && $Hand2[1] == "K") return 1;
      if ($Hand1[1] > $Hand2[1]) return 1;
      if ($Hand1[1] < $Hand2[1]) return -1;
      if ($Hand1[1] == $Hand2[1]) return 0;
    }
  }
  usort($Hand1, "f_sort");
  usort($Hand2, "f_sort");
  usort($Hand3, "f_sort");
  usort($Hand4, "f_sort");
  function losses_in_suit($Suit)
  {
    $counter = 0;
    if (sizeof($Suit) == 1) {
      if ($Suit[0][1] != "A") {
        $counter++;
      }
    }
    if (sizeof($Suit) == 2) {
      if (!($Suit[1][1] == "A" && $Suit[0][1] == "K")) {
        $counter++;
      }
      if ($Suit[1][1] != "A" && $Suit[1][1] != "K") {
        $counter++;
      }
    }
    if (sizeof($Suit) > 2) {
      $length = sizeof($Suit);
      if ($Suit[$length - 1][1] == "A" && $Suit[$length - 2][1] == "J" && $Suit[$length - 3][1] == "T") {
        return 1;
      }
      if ($Suit[$length - 1][1] == "K" && $Suit[$length - 2][1] == "J" && $Suit[$length - 3][1] == "T") {
        return 1;
      }
      if ($Suit[$length - 1][1] == "Q" && ($Suit[$length - 2][1] == "J" || $Suit[$length - 2][1] == "T")) {
        return 2;
      }
      if ($Suit[$length - 1][1] == "Q") {
        return 2.5;
      }
      if ($Suit[$length - 1][1] == "A" && $Suit[$length - 2][1] == "K" && $Suit[$length - 3][1] == "Q") {
        return 0;
      }
      if ($Suit[$length - 1][1] == "A" && $Suit[$length - 2][1] == "K") {
        return 1;
      }
      if ($Suit[$length - 1][1] == "A" && $Suit[$length - 2][1] == "Q") {
        return 1;
      }
      if ($Suit[$length - 1][1] == "K" && $Suit[$length - 2][1] == "Q") {
        return 1;
      }
      if ($Suit[$length - 1][1] == "A") {
        return 2;
      }
      if ($Suit[$length - 1][1] == "K") {
        return 2;
      }
      return 3;
    }
    return $counter;
  }
  function loss_counter($Hand)
  {
    $counter = 0;
    $Clubs = array();
    $Diamonds = array();
    $Hearts = array();
    $Spades = array();
    foreach ($Hand as $card) {
      if ($card[0] == "C") {
        $Clubs[] = $card;
      }
      if ($card[0] == "D") {
        $Diamonds[] = $card;
      }
      if ($card[0] == "H") {
        $Hearts[] = $card;
      }
      if ($card[0] == "S") {
        $Spades[] = $card;
      }
    }
    $counter = losses_in_suit($Clubs) + losses_in_suit($Diamonds) + losses_in_suit($Hearts) + losses_in_suit($Spades);
    return ceil($counter);
  }
  function show_hand($Hand)
  {
    echo '<div class="hand">';
    $HCP = 0;
    foreach ($Hand as $card) {
      if ($card[0] == 'C') {
        echo '<div class="card"><span class="clubs topsign">&clubs;</span><span class="clubs value">' . $card[1] . '</span><span class="clubs bottomsign">&clubs;</span></div>';
      }
      if ($card[0] == 'D') {
        echo '<div class="card"><span class="diamonds topsign">&diams;</span><span class="diamonds value">' . $card[1] . '</span><span class="diamonds bottomsign">&diams;</span></div>';
      }
      if ($card[0] == 'H') {
        echo '<div class="card"><span class="hearts topsign">&hearts;</span><span class="hearts value">' . $card[1] . '</span><span class="hearts bottomsign">&hearts;</span></div>';
      }
      if ($card[0] == 'S') {
        echo '<div class="card"><span class="spades topsign">&spades;</span><span class="spades value">' . $card[1] . '</span><span class="spades bottomsign">&spades;</span></div>';
      }
    }
    echo '</div>';
  }
  function show_player($Side, $Hidden, $N, $S, $E, $W)
  {
    $HCP = 0;
    echo "<div class='player'>";
    echo "<div class='side'>" . $Side . "</div>";
    echo '<div  class="button hideshow"  data-action="' . $Hidden . '"><span class="hsspan"></span></div>';

    switch ($Side) {
      case "N":
        $Left = "East";
        $Right = "West";
        $Hand = $N;
        break;
      case "S":
        $Left = "West";
        $Right = "East";
        $Hand = $S;
        break;
      case "E":
        $Left = "South";
        $Right = "West";
        $Hand = $E;
        break;
      case "W":
        $Left = "East";
        $Right = "South";
        $Hand = $W;
        break;
    }
    echo '<div class="button slider leftsl">' . $Left . '</div>';
    echo '<div class="button slider rightsl">' . $Right . '</div>';
    foreach ($Hand as $card) {
      if ($card[1] == 'A') {
        $HCP += 4;
      }
      if ($card[1] == 'K') {
        $HCP += 3;
      }
      if ($card[1] == 'Q') {
        $HCP += 2;
      }
      if ($card[1] == 'J') {
        $HCP += 1;
      }
    }
    show_hand($Hand);
    echo "</div>";
    echo '<div class="stats">';
    echo '<div class="counter">HCP = ' . $HCP . '</div><div class="counter">Losers: ' . loss_counter($Hand) . '</div>';
    echo '</div>';
  }
  show_player('N', "Hide", $Hand1, $Hand2, $Hand3, $Hand4);
  show_player('S', "Show", $Hand1, $Hand2, $Hand3, $Hand4);
  show_player('E', "Show", $Hand1, $Hand2, $Hand3, $Hand4);
  show_player('W', "Show", $Hand1, $Hand2, $Hand3, $Hand4);
  //show_hand($Hand2);
  $Hand1 = array_reverse($Hand1);
  $Hand2 = array_reverse($Hand2);
  $Hand3 = array_reverse($Hand3);
  $Hand4 = array_reverse($Hand4);
  $Deal = "S:";
  function hand_to_deal($Hand, $Deal)
  {
    switch ($Hand[0][0]) {
      case "H":
        $Deal .= ("." . $Hand[0][1]);
        break;
      case "D":
        $Deal .= (".." . $Hand[0][1]);
        break;
      case "C":
        $Deal .= ("..." . $Hand[0][1]);
        break;
      default:
        $Deal .= $Hand[0][1];
    }
    for ($i = 1; $i < 13; $i++) {
      if ($Hand[$i][0] == $Hand[$i - 1][0]) {
        $Deal .= $Hand[$i][1];
      } elseif (($Hand[$i][0] == "H") && ($Hand[$i - 1][0] == "S")) {
        $Deal .= ("." . $Hand[$i][1]);
      } elseif (($Hand[$i][0] == "D") && ($Hand[$i - 1][0] == "S")) {
        $Deal .= (".." . $Hand[$i][1]);
      } elseif (($Hand[$i][0] == "C") && ($Hand[$i - 1][0] == "S")) {
        $Deal .= ("..." . $Hand[$i][1]);
      } elseif (($Hand[$i][0] == "D") && ($Hand[$i - 1][0] == "H")) {
        $Deal .= ("." . $Hand[$i][1]);
      } elseif (($Hand[$i][0] == "C") && ($Hand[$i - 1][0] == "H")) {
        $Deal .= (".." . $Hand[$i][1]);
      } elseif (($Hand[$i][0] == "C") && ($Hand[$i - 1][0] == "D")) {
        $Deal .= ("." . $Hand[$i][1]);
      }
    }
    switch ($Hand[12][0]) {
      case "D":
        $Deal .= ".";
        break;
      case "H":
        $Deal .= "..";
        break;
      case "S":
        $Deal .= "...";
        break;
      default:
        $Deal .= "";
    }
    return $Deal;
  }
  $Deal = hand_to_deal($Hand2, $Deal);
  $Deal .= " ";
  $Deal = hand_to_deal($Hand4, $Deal);
  $Deal .= " ";
  $Deal = hand_to_deal($Hand1, $Deal);
  $Deal .= " ";
  $Deal = hand_to_deal($Hand3, $Deal);
  #print_r($Deal);
  echo '<div class="filter">';
  echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
  echo '<select name="filter">';
  if (isset($_POST['filter'])) {
    $Option = $_POST['filter'];
    if ($Option == 1) {
      echo '<option value="1" selected>All</option>';
      echo '<option value="2">Antispades Twos</option>';
      echo '<option value="3">15-17 HCP balanced</option>';
      echo '<option value="4" class="custom">Custom</option>';
    } elseif ($Option == 2) {
      echo '<option value="2" selected>Antispades Twos</option>';
      echo '<option value="1">All</option>';
      echo '<option value="3">15-17 HCP balanced</option>';
      echo '<option value="4" class="custom">Antispades 2&spades;</option>';
    } elseif ($Option == 3) {
      echo '<option value="3" selected>15-17 HCP balanced</option>';
      echo '<option value="1">All</option>';
      echo '<option value="2">Antispades Twos</option>';
      echo '<option value="4" class="custom">Antispades 2&spades;</option>';
    } elseif ($Option == 4) {
      echo '<option value="4" class="custom" selected>Antispades 2&spades;</option>';
      echo '<option value="1">All</option>';
      echo '<option value="2">Antispades Twos</option>';
      echo '<option value="3">15-17 HCP balanced</option>';
    }
  } else {
    echo '<option value="1">All</option>';
    echo '<option value="2">Antispades Twos</option>';
    echo '<option value="3">15-17 HCP balanced</option>';
    echo '<option value="4" class="custom">Antispades 2&spades;</option>';
  }
  echo '</select>';
  echo '<button type="submit" class="button" name="filterbutton" value="filter">New hand</button>';
  echo '</form>';
  echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
  echo "<input type='number' id='nmin' name='minhcp' value='" . $min . "' placeholder='min' class='customnumber' min='0' max='27'>";
  #echo '<label for="nmin" class="nlabel">min HCP</label>';
  echo "<input type='number' id='nmax' name='maxhcp' value='" . $max . "' placeholder='max' class='customnumber' min='0' max='27'>";
  echo "<br>";
  echo '<div class="checkboxcontainer">';
  $Checked = array();
  for ($i = 0; $i < 8; $i++) {
    $Checked[$i] = "";
  }
  if (isset($_POST['customizebutton'])) {
    if (isset($_POST['handtype'])) {
      $Conditions = $_POST['handtype'];
      foreach ($Conditions as $condition) {
        $Checked[$condition] = "checked";
      }
    }
  }

  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch0" value="0"' . $Checked[0] . '>';
  echo '<label for="ch0" class="chlabel" id="l0">Balanced</label>';
  #echo '</label>';

  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch1" value="1"' . $Checked[1] . '>';
  echo '<label for="ch1" class="chlabel" id="l1">Semibalanced</label>';
  #echo "</label>";
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch2" value="2"' . $Checked[2] . '>';
  echo '<label for="ch2" class="chlabel" id="l2">Unbalanced</label>';
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch3" value="3"' . $Checked[3] . '>';
  echo '<label for="ch3" class="chlabel" id="l3">Single-suited</label>';
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch4" value="4"' . $Checked[4] . '>';
  echo '<label for="ch4" class="chlabel" id="l4">Two-suited</label>';
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch5" value="5"' . $Checked[5] . '>';
  echo '<label for="ch5" class="chlabel" id="l5">Three-suited</label>';
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch6" value="6"' . $Checked[6] . '>';
  echo '<label for="ch6" class="chlabel" id="l6">Singleton</label>';
  echo '<input type="checkbox" name="handtype[]" class="checker" id="ch7" value="7"' . $Checked[7] . '>';
  echo '<label for="ch7" class="chlabel" id="l7">Void</label>';
  echo '</div>';
  echo '<button type="submit" id="cbutton" class="button" name="customizebutton" value="customize">Customize</button>';
  echo '</form>';
  echo '</div>';
  echo '<div class="controlbuttons">';
  echo "<form action='create.php' method='get'>";
  echo "<input type='text' name='deal' class='full' value='" . $Deal . "'>";
  echo "<button type='submit' class='button' name='createbutton' value='create'>Create pbn file</button>";
  echo '</form>';
  echo "<form action='todatabase.php' method='post'>";
  echo "<input type='text' name='deal' class='full' value='" . $Deal . "'>";
  echo '<textarea class="area bids" name="bids" cols="7" rows="4" placeholder="Bids"></textarea>';
  echo '<textarea class="area comments" name="comments" cols="21" rows="4" placeholder="Comments"></textarea>';
  echo "<button type='submit' class='button' name='datasavebutton' value='save'>Save to database</button>";
  echo "</form>";

  echo "<a href='enteringhand.php' class='button'>Enter hand manually</a>";


  echo "</form>";
  echo "<form action='logout.php' method='get'>";
  echo "<button type='submit' class='button' name='logoutbutton' value='logout'>Logout</button>";
  echo '</form>';
  echo '</div>';
  ob_end_flush();
  ?>
  <script type="text/javascript" src="checkboxprotection.js"></script>
  <script type="text/javascript" src="minmaxprotection.js"></script>
  <script type="text/javascript" src="hideshow.js"></script>
  <script type="text/javascript" src="cardsanimation.js"></script>
  <script type="text/javascript" src="handspreparation.js"></script>
</body>

</html>