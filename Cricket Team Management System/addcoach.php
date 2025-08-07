<?php
require_once 'connection.php';

// Define variables to store the error messages
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player details
  $CoachID = $_POST['CoachID'];
  $Status = $_POST['Status'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Email = $_POST['Email'];
  $YearsActive = $_POST['YearsActive'];
  $Salary = $_POST['Salary'];
  $Nationality = $_POST['Nationality'];
  $DOA = $_POST['DOA'];
  $DOR = $_POST['DOR'];

  // Check if the coach ID already exists in the database
  $checkQuery = "SELECT CoachID FROM coach WHERE CoachID = '$CoachID'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    $error = "Coach ID already preoccupied. Please choose a different Coach ID.";
  } else {
      // Insert the player details into the database
      $insertQuery = "INSERT INTO coach (CoachID, Status, FirstName, LastName, Email, YearsActive, Salary, Nationality, DOA, DOR) VALUES ('$CoachID', '$Status', '$FirstName', '$LastName', '$Email', '$YearsActive', '$Salary', '$Nationality', '$DOA', '$DOR')";
      $insertResult = mysqli_query($conn, $insertQuery);

      if ($insertResult) {
        header("Location: coach.php");
        exit();
      } else {
        $error = "Error adding coach details: " . mysqli_error($conn);
      }
    }
  // Close the database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="addcoach.css">
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
      Add Coach
    </h1>
    <hr>
  </div>
  </div>

  <div class="form-container">
    <form id="addForm" method="POST" action="addcoach.php">
      <label for="CoachID">Coach ID:</label>
      <input type="text" id="CoachID" name="CoachID" required>
      <br></br>
      <label for="Status">Status:</label>
      <input type="text" id="Status" name="Status" required>
      <br></br>
      <label for="FirstName">First Name:</label>
      <input type="text" id="FirstName" name="FirstName">
      <br></br>
      <label for="LastName">Last Name:</label>
      <input type="text" id="LastName" name="LastName">
      <br></br>
      <label for="Email">Email:</label>
      <input type="text" id="Email" name="Email">
      <br></br>
      <label for="YearsActive">Years Active:</label>
      <input type="text" id="YearsActive" name="YearsActive" required>
      <br></br>
      <label for="Salary">Salary:</label>
      <input type="text" id="Salary" name="Salary" required>
      <br></br>
      <label for="Nationality">Nationality:</label>
      <input type="text" id="Nationality" name="Nationality" required>
      <br></br>
      <label for="DOA">DOA:</label>
      <input type="text" id="DOA" name="DOA" required>
      <br></br>
      <label for="DOR">DOR:</label>
      <input type="text" id="DOR" name="DOR" required>
      <br></br>
      <button class="submit">Save</button>
    </form>
  </div>

  <script src="cscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>