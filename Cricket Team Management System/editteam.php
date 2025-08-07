<?php require_once 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="editteam.css">
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
      <h1>Edit Team</h1>
      <hr>
    </div>
  </div>

  <form method="POST" action="editteam.php" enctype="multipart/form-data">
  <div class="form-container">
      <label for="editTeamName">Team Name:</label>
      <input type="text" id="editTeamName" name="editTeamName" placeholder="Enter new team name" required>
      <br><br>
      <label for="blobInput">Upload Image:</label>
      <input type="file" id="blobInput" name="blobInput" accept="image/*">
      <br><br>
      <label for="editTC">Team Captain:</label>
      <input type="text" id="editTC" name="editTC" placeholder="Enter new team captain" required>
      <br><br>
      <label for="editWins">Wins:</label>
      <input type="text" id="editWins" name="editWins" placeholder="Enter updated wins" required>
      <br><br>
      <label for="editLosses">Losses:</label>
      <input type="number" id="editLosses" name="editLosses" placeholder="Enter updated losses" required>
      <br><br>
      <label for="editRanking">Ranking:</label>
      <input type="text" id="editRanking" name="editRanking" placeholder="Enter new ranking" required>
      <br><br>
      <label for="editHG">Home Ground:</label>
      <input type="text" id="editHG" name="editHG" placeholder="Enter home ground" required>
      <br><br>
      <label for="editPosition">Player ID:</label>
      <input type="text" id="editPosition" name="editPosition" placeholder="Enter the player ID of the captain" required>
      <br><br>
      <button type="submit" class="submit">Update</button>
    </div>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values from the form
    $editTeamName = $_POST['editTeamName'];
    $editTC = $_POST['editTC'];
    $editWins = $_POST['editWins'];
    $editLosses = $_POST['editLosses'];
    $editRanking = $_POST['editRanking'];
    $editHG = $_POST['editHG'];
    $editPosition = $_POST['editPosition'];

    // Handle the uploaded blob image file
    if ($_FILES["blobInput"]["error"] === UPLOAD_ERR_OK) {
      $targetDir = "C:/xampp/htdocs/Cricketv4imgs/";
      $targetFile = $targetDir . basename($_FILES["blobInput"]["name"]);
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      // Check if the file is an actual image
      $check = getimagesize($_FILES["blobInput"]["tmp_name"]);
      if ($check === false) {
        echo "File is not an image.";
        exit;
      }

      // Check file size (limit to 5MB)
      if ($_FILES["blobInput"]["size"] > 5242880) {
        echo "Sorry, the file is too large. Maximum size allowed is 5MB.";
        exit;
      }

      // Allow only specific image file formats
      $allowedFormats = ["jpg", "jpeg", "png", "gif"];
      if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        exit;
      }

      // Upload the file
      if (move_uploaded_file($_FILES["blobInput"]["tmp_name"], $targetFile)) {
        // Update query to modify the team data including the logo column
        $query = "UPDATE team SET TeamName = '$editTeamName', TeamCaptain = '$editTC', Wins = '$editWins', Losses = '$editLosses', Ranking = '$editRanking', HomeGround = '$editHG', Logo = ? WHERE PlayerID = '$editPosition'";

        // Prepare the query statement
        $stmt = mysqli_prepare($conn, $query);
        if (!$stmt) {
          echo "Error preparing the query: " . mysqli_error($conn);
          exit;
        }

        // Bind the logo parameter as a BLOB
        $logoData = file_get_contents($targetFile);
        mysqli_stmt_bind_param($stmt, "b", $logoData);

        // Execute the query
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
          header("Location: team.php");
          exit();
        } else {
          echo "Error updating team data: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    } else {
      // Update query to modify the team data based on PlayerID
      $query = "UPDATE team SET TeamName = '$editTeamName', TeamCaptain = '$editTC', Wins = '$editWins', Losses = '$editLosses', Ranking = '$editRanking', HomeGround = '$editHG' WHERE PlayerID = '$editPosition'";
      $result = mysqli_query($conn, $query);

      if ($result) {
        header("Location: team.php");
        exit();
      } else {
        echo "Error updating team data: " . mysqli_error($conn);
      }
    }
  }
  ?>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>