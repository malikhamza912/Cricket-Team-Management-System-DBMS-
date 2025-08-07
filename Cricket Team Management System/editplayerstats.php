<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
  <title>Cricket Team Management Portal</title>
  <link rel="stylesheet" href="editplayerstats.css">
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
    <h1>Edit Player Statistics
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
      <br></br>
      <br></br>
      <br></br>
    </h1>
    <hr>
    <table id="pstatsTable">
      <tbody>
        <!-- Player Stats details will be dynamically added here -->
        <tr>
            <th>PlayerID</th>
            <th>Matches</th>
            <th>Total Runs</th>
            <th>Fifty/Hundreds</th>
            <th>HS</th>
            <th>BF</th>
            <th>Average</th>
            <th>NO</th>
            <th>Maidens</th>
            <th>BB</th>
            <th>Overs</th>
            <th>Balls</th>
            <th>Wickets</th>
            <th>Runs Conceded</th>
          </tr>
        <!-- Player details will be dynamically added here -->
        <?php
        // Fetch playerstats details from the "playerstats" table
        $query = "SELECT PlayerID, TotalRuns, FiftyHundreds, HS, BF, Average, NO, Maidens, BB, Matches, Overs, Balls, Wickets, RunsConceded FROM playerstats";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
          // Loop through the result set and display the player details
          while ($row = mysqli_fetch_assoc($result)) {
            // Extract the column values from the current row        
            $PlayerID = $row['PlayerID'];
            $TotalRuns = $row['TotalRuns'];
            $FiftyHundreds = $row['FiftyHundreds'];
            $HS = $row['HS'];
            $BF = $row['BF'];
            $Average = $row['Average'];
            $NO = $row['NO'];
            $Maidens = $row['Maidens'];
            $BB = $row['BB'];
            $Matches = $row['Matches'];
            $Overs = $row['Overs'];
            $Balls = $row['Balls'];
            $Wickets = $row['Wickets'];
            $RunsConceded = $row['RunsConceded'];

            // Display the details in the HTML table
            echo "<tr>";
            echo "<td>$PlayerID</td>";
            echo "<td>$TotalRuns</td>";
            echo "<td>$FiftyHundreds</td>";
            echo "<td>$HS</td>";
            echo "<td>$BF</td>";
            echo "<td>$Average</td>";
            echo "<td>$NO</td>";
            echo "<td>$Maidens</td>";
            echo "<td>$BB</td>";
            echo "<td>$Matches</td>";
            echo "<td>$Overs</td>";
            echo "<td>$Balls</td>";
            echo "<td>$Wickets</td>";
            echo "<td>$RunsConceded</td>";
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
    <form id="editForm" action="playerstatsedit.php" method="POST">
      <input type="text" id="playerID" name="playerID" placeholder="Enter Player ID">
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
      
      // Retrieve the entered PlayerID
      const playerID = document.getElementById('playerID').value;

      // Create a new form dynamically
      const dynamicForm = document.createElement('form');
      dynamicForm.id = 'dynamicForm';
      dynamicForm.action = 'playerstatsedit.php';
      dynamicForm.method = 'POST';
      // Create input fields for updating player details
      const totalRunsInput = createInputField('totalRuns', 'Total Runs:', 'Enter updated total runs'
      );
      
      const fiftyHundredsInput = createInputField('fiftyHundreds', 'Fifty and Hundreds:', 'Enter updated 50s and 100s');
      const HSInput = createInputField('HS', 'HS:', 'Enter new high score');
      const BFInput = createInputField('BF', 'BF:', 'Enter updated no of balls faced');
      const averageInput = createInputField('average', 'Average:', 'Enter new average'
      );
      const NOInput = createInputField('NO', 'NOs:', 'Enter updated no. of not outs');
      const maidensInput = createInputField('maidens', 'Maidens:', 'Enter updated no of maidens');
      const BBInput = createInputField('BB', 'BB:', 'Enter updated best bowling');
      const matchesInput = createInputField('matches', 'Matches:', 'Enter updated no of matches'
      );
      const oversInput = createInputField('overs', 'Overs:', 'Enter updated no of overs');
      const ballsInput = createInputField('balls', 'Balls:', 'Enter updated no of balls');
      const wicketsInput = createInputField('wickets', 'Wickets:', 'Enter updated no of wickets');
      const runsConcededInput = createInputField('runsConceded', 'Runs Conceded:', 'Enter updated runs conceded');

      // Append the input fields to the dynamic form
      dynamicForm.appendChild(totalRunsInput);
      dynamicForm.appendChild(fiftyHundredsInput);
      dynamicForm.appendChild(HSInput);
      dynamicForm.appendChild(BFInput);
      dynamicForm.appendChild(averageInput);
      dynamicForm.appendChild(NOInput);
      dynamicForm.appendChild(maidensInput);
      dynamicForm.appendChild(BBInput);
      dynamicForm.appendChild(matchesInput);
      dynamicForm.appendChild(oversInput);
      dynamicForm.appendChild(ballsInput);
      dynamicForm.appendChild(wicketsInput);
      dynamicForm.appendChild(runsConcededInput);

      // Add a hidden input field for the player ID
      const playerIDInput = document.createElement('input');
      playerIDInput.type = 'hidden';
      playerIDInput.name = 'playerID';
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

  <script src="cscript.js"></script>

  <section class="overlay"></section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>