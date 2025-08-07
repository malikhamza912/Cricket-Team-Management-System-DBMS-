<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="editcoach.css">
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
    <h1>Edit Coach
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
      <br></br>
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
        // Fetch player details from the "player" table
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
    <form id="editForm" action="coachedit.php" method="POST">
        <br></br>
      <input type="text" id="CoachID" name="CoachID" placeholder="Enter Coach ID">
      <input type="submit" value="Edit">
      <br></br>
    <br></br>
    </form>
    <div id="editDataContainer"></div>
  </div>

  <script>
    // Get the form and the container elements
    const editForm = document.getElementById('editForm');
    const editDataContainer = document.getElementById('editDataContainer');

    // Add event listener to the form submission
    editForm.addEventListener('submit', (event) => {
      event.preventDefault();
      
      // Retrieve the entered CoachID
      const CoachID = document.getElementById('CoachID').value;

      // Create a new form dynamically
      const dynamicForm = document.createElement('form');
      dynamicForm.id = 'dynamicForm';
      dynamicForm.action = 'coachedit.php';
      dynamicForm.method = 'POST';

      // Create input fields for updating player details
      const StatusInput = createInputField('Status', 'Status:', 'Enter new status'
      );
      const FirstNameInput = createInputField('FirstName', 'First Name:', 'Enter first name');
      const LastNameInput = createInputField('LastName', 'Last Name:', 'Enter last name');
      const EmailInput = createInputField('Email', 'Email:', 'Enter new email');
      const YearsActiveInput = createInputField('YearsActive', 'Years Active:', 'Enter updated years active'
      );
      const SalaryInput = createInputField('Salary', 'Salary:', 'Enter new salary');
      const NationalityInput = createInputField('Nationality', 'Nationality:', 'Enter updated nationality');
      const DOAInput = createInputField('DOA', 'DOA:', 'Enter updated date of appointment');
      const DORInput = createInputField('DOR', 'DOR:', 'Enter updated date of retirement');

      // Append the input fields to the dynamic form
      dynamicForm.appendChild(StatusInput);
      dynamicForm.appendChild(FirstNameInput);
      dynamicForm.appendChild(LastNameInput);
      dynamicForm.appendChild(EmailInput);
      dynamicForm.appendChild(YearsActiveInput);
      dynamicForm.appendChild(SalaryInput);
      dynamicForm.appendChild(NationalityInput);
      dynamicForm.appendChild(DOAInput);
      dynamicForm.appendChild(DORInput);


      // Add a hidden input field for the player ID
      const CoachIDInput = document.createElement('input');
      CoachIDInput.type = 'hidden';
      CoachIDInput.name = 'CoachID';
      CoachIDInput.value = CoachID;
      dynamicForm.appendChild(CoachIDInput);

      // Add a submit button
      const submitButton = document.createElement('input');
      submitButton.type = 'submit';
      submitButton.value = 'Update';
      dynamicForm.appendChild(submitButton);

      // Clear the container and append the dynamic form
      editDataContainer.innerHTML = '';
      editDataContainer.appendChild(dynamicForm);
    });

    // Function to create an input field
    function createInputField(id, label, placeholder = '') {
      const labelElement = document.createElement('label');
      labelElement.for = id;
      labelElement.textContent = label;

      const inputElement = document.createElement('input');
      inputElement.type = 'text';
      inputElement.id = id;
      inputElement.name = id;
      inputElement.placeholder = placeholder;
      inputElement.required = true;

      const lineBreak = document.createElement('br');

      const container = document.createElement('div');
      container.appendChild(labelElement);
      container.appendChild(inputElement);
      container.appendChild(lineBreak);

      return container;
    }
  </script>
  <script src="cscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>