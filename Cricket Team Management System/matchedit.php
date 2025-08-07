<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MatchNo'])) {
  $matchNo = $_POST['MatchNo'];
  $date = $_POST['Date'];
  $time = $_POST['Time'];
  $location = $_POST['Location'];
  $opponentName = $_POST['OpponentName'];
  $matchType = $_POST['MatchType'];
  $matchStatus = $_POST['MatchStatus'];
  $result = $_POST['Result'];

  // Check if the match number exists in the matches table
  $checkQuery = "SELECT * FROM matches WHERE MatchNo = '$matchNo'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if ($checkResult) {
    if (mysqli_num_rows($checkResult) > 0) {
      // Match number exists, update the match details
      $updateQuery = "UPDATE matches SET Date = '$date', Time = '$time', Location = '$location', OpponentName = '$opponentName', MatchType = '$matchType', MatchStatus = '$matchStatus', Result = '$result' WHERE MatchNo = '$matchNo'";
      $updateResult = mysqli_query($conn, $updateQuery);

      if ($updateResult) {
        // Rows were updated, redirect to matches.php
        header("Location: matches.php");
        exit();
      } else {
        echo "Error updating match details: " . mysqli_error($conn);
      }
    } else {
      // No matching match number found, redirect with error message
      header("Location: editmatch.php?error=1");
      exit();
    }
  } else {
    echo "Error executing query: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>