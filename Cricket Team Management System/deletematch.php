<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="deletematch.css">
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
    <h1>Delete Match
      <br></br>
      <br></br>
    </h1>
    <hr>
    <table id="matchTable">
      <tbody>
        <!-- Player details will be dynamically added here -->
            <tr>
                <th>MatchNo</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Opponent Name</th>
                <th>Match Type</th>
                <th>Match Status</th>
                <th>Result</th>
              </tr>

            <?php
              $deleteResult = false;
        // Check if the delete button is pressed and a player ID is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matchno'])) {
            $MatchNo = $_POST['matchno'];
        
            // Check if the match number exists in the table
            $checkQuery = "SELECT * FROM matches WHERE MatchNo = '$MatchNo'";
            $checkResult = mysqli_query($conn, $checkQuery);
        
            if (mysqli_num_rows($checkResult) > 0) {
                // Delete the match from the database
                $deleteQuery = "DELETE FROM matches WHERE MatchNo = '$MatchNo'";
                $deleteResult = mysqli_query($conn, $deleteQuery);
        
                if ($deleteResult) {
                    header("Location: deletematch.php");
                    exit();
                } else {
                    echo "<p class='error-message'>Error deleting match: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p class='error-message'>Match number not found! Enter a valid Match No from the records.</p>";
            }
        }
        

        // Fetch match details from the "matches" table
        $query = "SELECT MatchNo, Date, Time, Location, OpponentName, MatchType, MatchStatus, Result FROM matches";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Loop through the result set and display the match details
          while ($row = mysqli_fetch_assoc($result)) {
            // Extract the column values from the current row        
            $MatchNo = $row['MatchNo'];
            $Date = $row['Date'];
            $Time = $row['Time'];
            $Location = $row['Location'];
            $OpponentName = $row['OpponentName'];
            $MatchType = $row['MatchType'];
            $MatchStatus = $row['MatchStatus'];
            $Result = $row['Result'];

            // Display the details in the HTML table
            echo "<tr>";
            echo "<td>$MatchNo</td>";
            echo "<td>$Date</td>";
            echo "<td>$Time</td>";
            echo "<td>$Location</td>";
            echo "<td>$OpponentName</td>";
            echo "<td>$MatchType</td>";
            echo "<td>$MatchStatus</td>";
            echo "<td>$Result</td>";
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
    <form id="editForm" method="post" action="deletematch.php">
      <input type="text" id="matchno" name="matchno" placeholder="Enter Match No">
      <button class="Delete">Delete</button>
    </form>
    <div id="editDataContainer"></div>
  </div>
  <script src="mscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>