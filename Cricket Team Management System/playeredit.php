<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player ID and updated details
  $playerID = $_POST['playerid'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $age = $_POST['age'];
  $position = $_POST['position'];

  // Update the player details in the database
  $query = "UPDATE player SET Name = '$name', Type = '$type', Age = '$age', Position = '$position' WHERE PlayerID = '$playerID'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: editplayer.php");
  exit();
  } else {
    echo "Error updating player details: " . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
