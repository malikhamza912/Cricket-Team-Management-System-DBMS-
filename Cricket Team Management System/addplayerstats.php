<?php
// addplayerstats.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $playerID = $_POST['id'];

    // Connect to the database
    require_once 'connection.php';

    // Check if the PlayerID exists in the player table
    $query = "SELECT * FROM player WHERE PlayerID = '$playerID'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if a player with the given PlayerID exists
        if (mysqli_num_rows($result) > 0) {
            // Retrieve the rest of the form data
            $totalRuns = $_POST['totalruns'];
            $fiftyHundreds = $_POST['fiftyhundreds'];
            $highestScore = $_POST['HS'];
            $ballsFaced = $_POST['BF'];
            $average = $_POST['average'];
            $notOuts = $_POST['NO'];
            $maidens = $_POST['maidens'];
            $bestBowling = $_POST['BB'];
            $matches = $_POST['matches'];
            $oversBowled = $_POST['overs'];
            $ballsBowled = $_POST['balls'];
            $wickets = $_POST['wickets'];
            $runsConceded = $_POST['runsconceded'];

            // Insert player stats into the playerstats table
            $insertQuery = "INSERT INTO playerstats (PlayerID, TotalRuns, FiftyHundreds, HS, BF, Average, NO, Maidens, BB, Matches, Overs, Balls, Wickets, RunsConceded) VALUES ('$playerID', '$totalRuns', '$fiftyHundreds', '$highestScore', '$ballsFaced', '$average', '$notOuts', '$maidens', '$bestBowling', '$matches', '$oversBowled', '$ballsBowled', '$wickets', '$runsConceded')";
            $insertResult = mysqli_query($conn, $insertQuery);

            // Check if the insertion was successful
            if ($insertResult) {
                header("Location: playerstats.php");
                exit();
            } else {
                echo 'Error adding player stats: ' . mysqli_error($conn);
            }
        } else {
            echo '<div class="error-message">PlayerID ' . $playerID . ' does not exist in the player table.</div>';
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        echo 'Error executing query: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="addplayerstats.css">
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
      Add Player Stats
    </h1>
    <hr>
  </div>
  </div>

  <div class="form-container">
    <form id="addForm" method="POST" action="addplayerstats.php">
      <label for="id">PlayerID:</label>
      <input type="text" id="id" name="id" required placeholder="Enter Player ID">
      <br></br>
      <label for="totalruns">Total Runs:</label>
      <input type="text" id="totalruns" name="totalruns" placeholder="Enter total no of runs">
      <br></br>
      <label for="fiftyhundreds">Fifty/Hundreds:</label>
      <input type="text" id="fiftyhundreds" name="fiftyhundreds" placeholder="Enter fifties and hundreds">
      <br></br>
      <label for="HS">HS:</label>
      <input type="text" id="HS" name="HS" placeholder="Enter highest score">
      <br></br>
      <label for="BF">BF:</label>
      <input type="text" id="BF" name="BF" placeholder="Enter no of balls faced">
      <br></br>
      <label for="average">Average:</label>
      <input type="text" id="average" name="average" placeholder="Enter average of player">
      <br></br>
      <label for="NO">NOs:</label>
      <input type="text" id="NO" name="NO" placeholder="Enter no of not-outs">
      <br></br>
      <label for="maidens">Maidens:</label>
      <input type="text" id="maidens" name="maidens" placeholder="Enter no of maidens">
      <br></br>
      <label for="BB">BB:</label>
      <input type="text" id="BB" name="BB" placeholder="Enter best bowling figures">
      <br></br>
      <label for="matches">Matches:</label>
      <input type="text" id="matches" name="matches" required placeholder="Enter no of matches">
      <br></br>
      <label for="overs">Overs Bowled:</label>
      <input type="text" id="overs" name="overs" placeholder="Enter no of overs bowled">
      <br></br>
      <label for="balls">Balls Bowled:</label>
      <input type="text" id="balls" name="balls" placeholder="Enter no of balls bowled">
      <br></br>
      <label for="wickets">Wickets:</label placeholder="Enter no of wickets taken">
      <input type="text" id="wickets" name="wickets">
      <br></br>
      <label for="runsconceded">Runs Conceded:</label placeholder="Enter total runs conceded">
      <input type="text" id="runsconceded" name="runsconceded">
      <br></br>
      <button class="submit">Save</button>
    </form>
  </div>

  <?php if (isset($errorMessage)) { ?>
    <div class="error-message"><?php echo $errorMessage; ?></div>
  <?php } ?>
  
  <script src="psscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>