<?php require_once 'connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="team.css">
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
    <h1>Team Details
      <br></br>
    </h1>
    <hr>
    <table id="teamTable">
        <thead>
        <tr>
          <th>Team Name</th>
          <th>Logo</th>
          <th>Team Captain</th>
          <th>Wins</th>
          <th>Losses</th>
          <th>Ranking</th>
          <th>Home Ground</th>
          <th>PlayerID</th>        
        </tr>
        </thead>
        <tbody>
        <!-- Player details will be dynamically added here -->
        <?php
        // Fetch team details from the "team" table
        $query = "SELECT TeamName, TeamCaptain, Wins, Losses, Ranking, HomeGround, Logo, PlayerID FROM team";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
        // Loop through the result set and display the team details
        while ($row = mysqli_fetch_assoc($result)) {
        // Extract the column values from the current row
        $teamName = $row['TeamName'];
        $teamCaptain = $row['TeamCaptain'];
        $wins = $row['Wins'];
        $losses = $row['Losses'];
        $ranking = $row['Ranking'];
        $homeGround = $row['HomeGround'];
        $logo = $row['Logo'];
        $playerID = $row['PlayerID'];

        // Display the details in the HTML table
        echo "<tr>";
        echo "<td>$teamName</td>";
        // Display the logo if it is stored as BLOB
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($logo) . "'></td>";
        echo "<td>$teamCaptain</td>";
        echo "<td>$wins</td>";
        echo "<td>$losses</td>";
        echo "<td>$ranking</td>";
        echo "<td>$homeGround</td>";
        echo "<td>$playerID</td>";
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
    <div class="action-buttons">
      <a href="editteam.php"><button class="edit-button">Edit Team</button></a>
    </div>
  </div>
  </div>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
