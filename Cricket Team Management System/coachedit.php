<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the entered player ID and updated details
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

  // Update the coach details in the database
  $query = "UPDATE coach SET Status = '$Status', FirstName = '$FirstName', LastName = '$LastName', Email = '$Email', YearsActive = '$YearsActive', Salary = '$Salary', Nationality = '$Nationality', DOA = '$DOA', DOR = '$DOR' WHERE CoachID = '$CoachID'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: editcoach.php");
  exit();
  } else {
    echo "Error updating coach details: " . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
