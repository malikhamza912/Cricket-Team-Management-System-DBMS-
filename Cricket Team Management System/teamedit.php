<?php
require_once 'connection.php';

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