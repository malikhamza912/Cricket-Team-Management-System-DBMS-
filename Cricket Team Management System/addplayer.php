<?php
require_once 'connection.php';

// Define variables to store the error messages
$error = '';
$error2 = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player details
  $playerID = $_POST['id'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $age = $_POST['age'];
  $position = $_POST['position'];

  // Check if the player ID already exists in the database
  $checkQuery = "SELECT PlayerID FROM player WHERE PlayerID = '$playerID'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    $error = "Player ID already exists. Please choose a different Player ID.";
  } else {
    // Check if the Position already exists in the database
    $checkPositionQuery = "SELECT Position FROM player WHERE Position = '$position'";
    $checkPositionResult = mysqli_query($conn, $checkPositionQuery);

    if (mysqli_num_rows($checkPositionResult) > 0) {
      $error2 = "This position is already assigned. Please choose a different position for this player.";
    } else {
      // Insert the player details into the database
      $insertQuery = "INSERT INTO player (PlayerID, Name, Type, Age, Position) VALUES ('$playerID', '$name', '$type', '$age', '$position')";
      $insertResult = mysqli_query($conn, $insertQuery);

      if ($insertResult) {
        header("Location: players.php");
        exit();
      } else {
        $error = "Error adding player details: " . mysqli_error($conn);
      }
    }
  }
  // Close the database connection
  mysqli_close($conn);
}
?>

<!-- Rest of the HTML code -->
<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="addplayer.css">
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
          <a href="matches.html" class="nav-link">
            <span class="menu-icon"><ion-icon name="trophy-outline"></ion-icon></span>
            <span class="link">Matches</span>
          </a>
        </li><br>
        <li class="list">
          <a href="coach.html" class="nav-link">
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
      Add Players
    </h1>
    <hr>
  </div>
  </div>

  <div class="form-container">
    <form id="addForm" method="POST" action="addplayer.php">
      <label for="id">PlayerID:</label>
      <input type="text" id="id" name="id" required>
      <?php if ($error !== '') { echo "<span class='error'>$error</span>"; } ?>
      <br></br>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <br></br>
      <label for="type">Type:</label>
      <input type="text" id="type" name="type" required>
      <br></br>
      <label for="age">Age:</label>
      <input type="number" id="age" name="age" required>
      <br></br>
      <label for="position">Position:</label>
      <input type="text" id="position" name="position" required>
      <?php if ($error2 !== '') { echo "<span class='error'>$error2</span>"; } ?>
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