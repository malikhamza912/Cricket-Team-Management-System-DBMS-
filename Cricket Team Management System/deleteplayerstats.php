<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="deleteplayerstats.css">
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
    <h1>Delete Player Statistics
      <br></br>
      <br></br>
    </h1>
    <hr>
    <table id="pstatsTable">
      <tbody>
        <!-- Player details will be dynamically added here -->
        <tr>
          <th>PlayerID</th>
          <th>Matches</th>
          <th>Total Runs</th>
          <th>Fifty/Hundreds</th>
          <th>HS</th>
          <th>BF</th>
          <th>Average</th>
          <th>NO</th>
          <th>Maidens</th>
          <th>BB</th>
          <th>Overs</th>
          <th>Balls</th>
          <th>Wickets</th>
          <th>Runs Conceded</th>
        </tr>

        <?php
        $deleteResult = false;
        // Check if the delete button is pressed and a player ID is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['playerid'])) {
          $playerId = $_POST['playerid'];

          // Check if the player ID exists in the table
          $checkQuery = "SELECT * FROM playerstats WHERE PlayerID = '$playerId'";
          $checkResult = mysqli_query($conn, $checkQuery);

          if (mysqli_num_rows($checkResult) > 0) {
            // Delete the player from the database
            $deleteQuery = "DELETE FROM playerstats WHERE PlayerID = '$playerId'";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
              header("Location: deleteplayerstats.php");
              exit();
            } else {
              echo "<p>Error deleting player: " . mysqli_error($conn) . "</p>";
            }
          }
        }

        // Fetch playerstats details from the "playerstats" table
        $query = "SELECT PlayerID, TotalRuns, FiftyHundreds, HS, BF, Average, NO, Maidens, BB, Matches, Overs, Balls, Wickets, RunsConceded FROM playerstats";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Loop through the result set and display the player details
          while ($row = mysqli_fetch_assoc($result)) {
            // Extract the column values from the current row        
            $PlayerID = $row['PlayerID'];
            $TotalRuns = $row['TotalRuns'];
            $FiftyHundreds = $row['FiftyHundreds'];
            $HS = $row['HS'];
            $BF = $row['BF'];
            $Average = $row['Average'];
            $NO = $row['NO'];
            $Maidens = $row['Maidens'];
            $BB = $row['BB'];
            $Matches = $row['Matches'];
            $Overs = $row['Overs'];
            $Balls = $row['Balls'];
            $Wickets = $row['Wickets'];
            $RunsConceded = $row['RunsConceded'];

            // Display the details in the HTML table
            echo "<tr>";
            echo "<td>$PlayerID</td>";
            echo "<td>$TotalRuns</td>";
            echo "<td>$FiftyHundreds</td>";
            echo "<td>$HS</td>";
            echo "<td>$BF</td>";
            echo "<td>$Average</td>";
            echo "<td>$NO</td>";
            echo "<td>$Maidens</td>";
            echo "<td>$BB</td>";
            echo "<td>$Matches</td>";
            echo "<td>$Overs</td>";
            echo "<td>$Balls</td>";
            echo "<td>$Wickets</td>";
            echo "<td>$RunsConceded</td>";
            echo "</tr>";
          }

          // Free the result set
          mysqli_free_result($result);
        } else {
          echo "Error executing query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </div>
  </div>

  <div class="form-container">
    <form id="deleteForm" method="POST" action="deleteplayerstats.php">
      <input type="text" id="playerid" name="playerid" placeholder="Enter Player ID">
      <button class="Delete" type="submit">Delete</button>
    </form>
    <?php
      if ($deleteResult) {
        header("Location: deleteplayerstats.php");
        exit();
      } 
    ?>
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['playerid'])) {
        echo "<div class='error-message-container'><p class='error-message'>No such player exists in the table!</p></div>";
      }
    ?>
    <div id="editDataContainer"></div>
  </div>
  <script src="mscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
