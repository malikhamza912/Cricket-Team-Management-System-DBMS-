<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="players.css">
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
    <h1>Player Details
      <br></br>
      <br></br>
    </h1>
    <hr>
    <table id="playerTable">
      <thead>
        <tr>
          <th>PlayerID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Age</th>
          <th>Position</th>
        </tr>

      </thead>
      <tbody>
        <!-- Player details will be dynamically added here -->
        <?php
        // Fetch player details from the "player" table
        $query = "SELECT PlayerID, Name, Type, Age, Position FROM player";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
        // Loop through the result set and display the player details
        while ($row = mysqli_fetch_assoc($result)) {
        // Extract the column values from the current row        
        $PlayerID = $row['PlayerID'];
        $Name = $row['Name'];
        $Type = $row['Type'];
        $Age = $row['Age'];
        $Position = $row['Position'];

        // Display the details in the HTML table
        echo "<tr>";
        echo "<td>$PlayerID</td>";
        echo "<td>$Name</td>";
        echo "<td>$Type</td>";
        echo "<td>$Age</td>";
        echo "<td>$Position</td>";
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
      <a href="editplayer.php"><button class="edit-button">Edit</button></a>
      <a href="addplayer.php"><button class="add-button">Add</button></a>
      <a href="deleteplayer.php"><button class="delete-button">Delete</button></a>
      <a href="playerstats.php"><button class="view-button">PlayerStats</button></a>
    </div>
  </div>
  </div>
  <script src="pscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
