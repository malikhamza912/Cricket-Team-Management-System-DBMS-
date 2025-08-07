<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>Cricket Team Management System</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php
    // Initialize the error message variable
    $errorMessage = '';

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the entered username and password
        $username = $_POST['userid'];
        $password = $_POST['password'];

        // Check if the entered credentials are correct
        if ($username === 'admin' && $password === 'admin') 
        {
            // Redirect the user to the front page
            header('Location: frontpage.html');
            exit;
        } 
        else 
        {
            // Set the error message
            $errorMessage = 'Your username or password is incorrect!';
        }
    }
    ?>

    <header>
        <h2> Cricket Team Management System</h2>
        <nav class="navigation">
            <button class="btnLogin-popup">Login</button>
        </nav>
    </header> 

    <div class="wrapper active-popup">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box login">
            <h2>Login</h2>
            <?php if ($errorMessage !== '') { ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php } ?>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <label>User ID:</label>
                    <input type="text" name="userid" required>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
