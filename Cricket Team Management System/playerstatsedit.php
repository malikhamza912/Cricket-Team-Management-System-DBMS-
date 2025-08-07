<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player ID and updated details
  $playerID = $_POST['playerID'];
  $totalRuns = $_POST['totalRuns'];
  $fiftyHundreds = $_POST['fiftyHundreds'];
  $HS = $_POST['HS'];
  $BF = $_POST['BF'];
  $average = $_POST['average'];
  $NO = $_POST['NO'];
  $maidens = $_POST['maidens'];
  $BB = $_POST['BB'];
  $matches = $_POST['matches'];
  $overs = $_POST['overs'];
  $balls = $_POST['balls'];
  $wickets = $_POST['wickets'];
  $runsConceded = $_POST['runsConceded'];

  // Update the player statistics in the database
  $query = "UPDATE playerstats SET TotalRuns = '$totalRuns', FiftyHundreds = '$fiftyHundreds', HS = '$HS', BF = '$BF', Average = '$average', NO = '$NO', Maidens = '$maidens', BB = '$BB', Matches = '$matches', Overs = '$overs', Balls = '$balls', Wickets = '$wickets', RunsConceded = '$runsConceded' WHERE PlayerID = '$playerID'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: editplayerstats.php");
    exit();
  } else {
    echo "Error updating player statistics: " . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
