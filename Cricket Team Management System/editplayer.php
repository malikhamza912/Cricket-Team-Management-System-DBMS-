<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="editplayer.css">
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
      Edit Player
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
      <table id="playerTable">
        <thead>
        <tr>
          <th>PlayerID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Age</th>
          <th>Position</th>
        </tr>
      </thead>
      <tbody>
        <!-- Player details will be dynamically added here -->
        <?php
        // Fetch player details from the "player" table
        $query = "SELECT PlayerID, Name, Type, Age, Position FROM player";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Loop through the result set and display the player details
          while ($row = mysqli_fetch_assoc($result)) {
            // Extract the column values from the current row        
            $PlayerID = $row['PlayerID'];
            $Name = $row['Name'];
            $Type = $row['Type'];
            $Age = $row['Age'];
            $Position = $row['Position'];

            // Display the details in the HTML table
            echo "<tr>";
            echo "<td>$PlayerID</td>";
            echo "<td>$Name</td>";
            echo "<td>$Type</td>";
            echo "<td>$Age</td>";
            echo "<td>$Position</td>";
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
  <form id="editForm" action="playeredit.php" method="POST">
    <br></br>
    <label for="playerid">Enter PlayerID of the player to update:</label>
    <input type="text" id="playerid" name="playerid" required>
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
      
      // Retrieve the entered PlayerID
      const playerID = document.getElementById('playerid').value;

      // Create a new form dynamically
      const dynamicForm = document.createElement('form');
      dynamicForm.id = 'dynamicForm';
      dynamicForm.action = 'playeredit.php';
      dynamicForm.method = 'POST';

      // Create input fields for updating player details
      const nameInput = createInputField('name', 'Name:', 'Enter new name'
      );
      const typeInput = createInputField('type', 'Type of Player:', 'Enter new type');
      const ageInput = createInputField('age', 'Age:', 'Enter new age');
      const positionInput = createInputField('position', 'Position:', 'Enter new position of player');

      // Append the input fields to the dynamic form
      dynamicForm.appendChild(nameInput);
      dynamicForm.appendChild(typeInput);
      dynamicForm.appendChild(ageInput);
      dynamicForm.appendChild(positionInput);

      // Add a hidden input field for the player ID
      const playerIDInput = document.createElement('input');
      playerIDInput.type = 'hidden';
      playerIDInput.name = 'playerid';
      playerIDInput.value = playerID;
      dynamicForm.appendChild(playerIDInput);

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

<section class="overlay"></section>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
