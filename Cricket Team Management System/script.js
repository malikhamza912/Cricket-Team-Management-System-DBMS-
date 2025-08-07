// Get the necessary elements
const loginButton = document.querySelector('.btnLogin-popup');
const loginFormWrapper = document.querySelector('.wrapper');
const closeButton = document.querySelector('.icon-close');

// Function to show the login form
const showLoginForm = () => {
  loginFormWrapper.classList.add('active-popup');
};

// Function to hide the login form
const hideLoginForm = () => {
  loginFormWrapper.classList.remove('active-popup');
};

// Add click event listeners to the Login button and close-outline icon
loginButton.addEventListener('click', showLoginForm);
closeButton.addEventListener('click', hideLoginForm);
