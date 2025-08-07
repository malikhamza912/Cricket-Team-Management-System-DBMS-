<?php
require_once 'connection.php';

// Define variables to store the error messages
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player details
  $matchno = $_POST['matchno'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $location = $_POST['location'];
  $opponentname = $_POST['opponentname'];
  $matchtype = $_POST['matchtype'];
  $matchstatus = $_POST['matchstatus'];
  $result = $_POST['result'];

  // Check if the player ID already exists in the database
  $checkQuery = "SELECT MatchNo FROM matches WHERE MatchNo = '$matchno'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    $error = "Match No already exists. Please choose a different Match No.";
  } else {

      // Insert the player details into the database
      $insertQuery = "INSERT INTO matches (MatchNo, Date, Time, Location, OpponentName, MatchType, MatchStatus, Result) VALUES ('$matchno', '$date', '$time', '$location', '$opponentname', '$matchtype', '$matchstatus', '$result')";
      $insertResult = mysqli_query($conn, $insertQuery);

      if ($insertResult) {
        header("Location: matches.php");
        exit();
      } else {
        $error = "Error adding team details: " . mysqli_error($conn);
      }
    }
  }
  // Close the database connection
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="addmatch.css">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cricket Team Management Portal</title>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <header>
    <h2>Cricket Team Management Portal</h2>
    <div class="navigation">
      <a href="loginform.php"><button class="btnLogin-popup">Logout</button></a>
    </div>
  </header>

  <nav class="sidebar">
    <div class="sidebar-content">
      <ul class="lists">
        <li class="list">
          <br>
        <a href="frontpage.html" class="nav-link">
          <span class="menu-icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="link">Home</span>
        </a>
      </li><br>
        <li class="list">
          <a href="team.php" class="nav-link">
            <span class="menu-icon"><ion-icon name="people-circle-outline"></ion-icon></span>
            <span class="link">Team</span>
          </a>
        </li><br>
        <li class="list">
          <a href="players.php" class="nav-link">
            <span class="menu-icon"><ion-icon name="person-circle-outline"></ion-icon></span>
            <span class="link">Players</span>
          </a>
        </li><br>
        <li class="list">
          <a href="matches.php" class="nav-link">
            <span class="menu-icon"><ion-icon name="trophy-outline"></ion-icon></span>
            <span class="link">Matches</span>
          </a>
        </li><br>
        <li class="list">
          <a href="coach.php" class="nav-link">
            <span class="menu-icon"><ion-icon name="accessibility-outline"></ion-icon></span>
            <span class="link">Coach</span>
          </a>
        </li><br>
      </ul>
    </div>
  </nav>

  <div class="page-content">
  <div class="content">
    <h1>
      Add Matches
    </h1>
    <hr>
  </div>
  </div>

  <div class="form-container">
    <form id="addForm" action="addmatch.php" method="POST">
      <label for="matchno">Match No:</label>
      <input type="text" id="matchno" name="matchno" required>
      <?php if ($error !== '') { echo "<span class='error'>$error</span>"; } ?>
      <br></br>
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" required>
      <br></br>
      <label for="time">Time:</label>
      <input type="time" id="time" name="time" required>
      <br></br>
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" required>
      <br></br>
      <label for="opponentname">Opponent Name:</label>
      <input type="text" id="opponentname" name="opponentname" required>
      <br></br>
      <label for="matchtype">Match Type:</label>
      <input type="text" id="matchtype" name="matchtype" required>
      <br></br>
      <label for="matchstatus">Match Status:</label>
      <input type="text" id="matchstatus" name="matchstatus" required>
      <br></br>
      <label for="result">Result:</label>
      <input type="text" id="result" name="result" required>
      <br></br>
      <button class="submit">Save</button>
    </form>
  </div>

  <script src="pscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>