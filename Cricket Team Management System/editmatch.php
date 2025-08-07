<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="editmatch.css">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <h1>Edit Match
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
    <table id="matchTable">
    <thead>
        <tr>
          <th>MatchNo</th>
          <th>Date</th>
          <th>Time</th>
          <th>Location</th>
          <th>Opponent Name</th>
          <th>Match Type</th>
          <th>Match Status</th>
          <th>Result</th>
        </tr>
      </thead>
      <tbody>
        <!-- Match details will be dynamically added here -->
        <?php
        // Fetch match details from the "matches" table
        $query = "SELECT MatchNo, Date, Time, Location, OpponentName, MatchType, MatchStatus, Result FROM matches";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Loop through the result set and display the match details
          while ($row = mysqli_fetch_assoc($result)) {
            // Extract the column values from the current row        
            $MatchNo = $row['MatchNo'];
            $Date = $row['Date'];
            $Time = $row['Time'];
            $Location = $row['Location'];
            $OpponentName = $row['OpponentName'];
            $MatchType = $row['MatchType'];
            $MatchStatus = $row['MatchStatus'];
            $Result = $row['Result'];

            // Display the details in the HTML table
            echo "<tr>";
            echo "<td>$MatchNo</td>";
            echo "<td>$Date</td>";
            echo "<td>$Time</td>";
            echo "<td>$Location</td>";
            echo "<td>$OpponentName</td>";
            echo "<td>$MatchType</td>";
            echo "<td>$MatchStatus</td>";
            echo "<td>$Result</td>";
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
    <form id="editForm" method="POST" action="matchedit.php">
      <br></br>
      <input type="text" id="MatchNo" name="MatchNo" placeholder="Enter Match No">
      <input type="submit" value="Edit">
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
      
      // Retrieve the entered MatchNo
      const MatchNo = document.getElementById('MatchNo').value;

      // Create a new form dynamically
      const dynamicForm = document.createElement('form');
      dynamicForm.id = 'dynamicForm';
      dynamicForm.action = 'matchedit.php';
      dynamicForm.method = 'POST';

      // Create input fields for updating player details
      const DateInput = createInputField('Date', 'Date:', 'Enter new date'
      );
      const TimeInput = createInputField('Time', 'Time:', 'Enter new time');
      const LocationInput = createInputField('Location', 'Location:', 'Enter new location');
      const OpponentNameInput = createInputField('OpponentName', 'Opponent Name:', 'Enter new opponent name');
      const MatchTypeInput = createInputField('MatchType', 'Match Type:', 'Enter new match type');
      const MatchStatusInput = createInputField('MatchStatus', 'Match Status:', 'Enter new match status');
      const ResultInput = createInputField('Result', 'Result:', 'Enter updated result');

      // Append the input fields to the dynamic form
      dynamicForm.appendChild(DateInput);
      dynamicForm.appendChild(TimeInput);
      dynamicForm.appendChild(LocationInput);
      dynamicForm.appendChild(OpponentNameInput);
      dynamicForm.appendChild(MatchTypeInput);
      dynamicForm.appendChild(MatchStatusInput);
      dynamicForm.appendChild(ResultInput);

      // Add a hidden input field for the player ID
      const MatchNoInput = document.createElement('input');
      MatchNoInput.type = 'hidden';
      MatchNoInput.name = 'MatchNo';
      MatchNoInput.value = MatchNo;
      dynamicForm.appendChild(MatchNoInput);

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
  <?php
  if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo '<div class="error-message">Error: No matching match number found. Please enter a valid Match No.</div>';
  }
  ?>
  
  <script src="mscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
