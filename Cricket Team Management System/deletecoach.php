<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="deletecoach.css">
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
    <h1>Delete Coach
      <br></br>
      <br></br>
    </h1>
    <hr>
    <table id="coachTable">
        <thead>
        <tr>
            <th>CoachID</th>
            <th>Status</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Years Active</th>
            <th>Salary</th>
            <th>Nationality</th>
            <th>DOA</th>
            <th>DOR</th>
          </tr>
</thead>
      <tbody>
        <!-- Coach details will be dynamically added here -->  
        <?php
              $deleteResult = false;
        // Check if the delete button is pressed and a Coach ID is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CoachID'])) {
            $CoachID = $_POST['CoachID'];
        
            // Check if the coach ID exists in the table
            $checkQuery = "SELECT * FROM coach WHERE CoachID = '$CoachID'";
            $checkResult = mysqli_query($conn, $checkQuery);
        
            if (mysqli_num_rows($checkResult) > 0) {
                // Delete the record from the database
                $deleteQuery = "DELETE FROM coach WHERE CoachID = '$CoachID'";
                $deleteResult = mysqli_query($conn, $deleteQuery);
        
                if ($deleteResult) {
                    header("Location: deletecoach.php");
                    exit();
                } else {
                    echo "<p class='error-message'>Error deleting coach: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p class='error-message'>Coach not found! Enter a valid Coach ID from the records.</p>";
            }
        } 
        // Fetch coach details from the "player" table
        $query = "SELECT CoachID, Status, FirstName, LastName, Email, YearsActive, Salary, Nationality, DOA, DOR FROM coach";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
        // Loop through the result set and display the player details
        while ($row = mysqli_fetch_assoc($result)) {
        // Extract the column values from the current row        
        $CoachID = $row['CoachID'];
        $Status = $row['Status'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Email = $row['Email'];
        $YearsActive = $row['YearsActive'];
        $Salary = $row['Salary'];
        $Nationality = $row['Nationality'];
        $DOA = $row['DOA'];
        $DOR = $row['DOR'];

        // Display the details in the HTML table
        echo "<tr>";
        echo "<td>$CoachID</td>";
        echo "<td>$Status</td>";
        echo "<td>$FirstName</td>";
        echo "<td>$LastName</td>";
        echo "<td>$Email</td>";
        echo "<td>$YearsActive</td>";
        echo "<td>$Salary</td>";
        echo "<td>$Nationality</td>";
        echo "<td>$DOA</td>";
        echo "<td>$DOR</td>";
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
    <form id="editForm" method="post" action="deletecoach.php">
      <input type="text" id="CoachID" name="CoachID" placeholder="Enter Coach ID">
      <button class="Delete">Delete</button>
    </form>
    <div id="editDataContainer"></div>
  </div>
  <script src="cscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>