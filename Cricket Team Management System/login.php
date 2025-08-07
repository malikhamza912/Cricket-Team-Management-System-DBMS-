<?php
    session_start();
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