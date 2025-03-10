<?php
require('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullName = $_POST['fullName'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  if (!empty($fullName) && !empty($email) && !empty($password)) {
    $sql = "INSERT INTO users (fullName, email, password) VALUES ('$fullName', '$email', '$password')";
    if ($con->query($sql) === TRUE) {
      echo "REGISTERED SUCCESSFULLY";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
    $con->close();
  } else {
    echo "All fields are required";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="login-signup-style.css">
</head>

<body>
  <div class="back">
    <div class="back-btn">
      <h2><a href="Dashboard/index.html">BACK TO HOME</a></h2>
    </div>
  </div>
  <form id="registrationForm" onsubmit="return validateForm()" method="post">
    <h2>REGISTER</h2>
    <label for="fullName">Full Name:</label><br>
    <input type="text" id="fullName" name="fullName" onblur="validateFullName()"><br>
    <span id="fullNameError" class="error">Please enter a valid full name.</span><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" onblur="validateEmail()"><br>
    <span id="emailError" class="error">Please enter a valid email ending with '@gmail.com'.</span><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" onblur="validatePassword()"><br>
    <span id="passwordError" class="error">Please enter a valid password.</span><br>
    <label for="confirmPassword">Confirm Password:</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword" onblur="validateConfirmPassword()"><br>
    <span id="confirmPasswordError" class="error">Passwords do not match.</span><br>
    <input type="submit" value="Submit">
    <div class="footer">
      <p>Already have an account? <a href="login.php">LOGIN NOW</a></p>
    </div>
  </form>
  <script>
    function validateForm() {
      var isValid = true;
      if (!validateFullName()) {
        isValid = false;
      }
      if (!validateEmail()) {
        isValid = false;
      }
      if (!validatePassword()) {
        isValid = false;
      }
      if (!validateConfirmPassword()) {
        isValid = false;
      }
      return isValid;
    }
    function validateFullName() {
      var fullNameInput = document.getElementById('fullName');
      var fullNameError = document.getElementById('fullNameError');

      if (fullNameInput.value.trim() === '') {
        fullNameError.style.display = 'inline';
        return false;
      } else if (!/^[a-zA-Z\s]+$/.test(fullNameInput.value.trim())) {
        fullNameError.innerText = 'Please enter only alphabets.';
        fullNameError.style.display = 'inline';
        return false;
      } else {
        fullNameError.style.display = 'none';
        return true;
      }
    }
    function validateEmail() {
      var emailInput = document.getElementById('email');
      var emailError = document.getElementById('emailError');

      if (emailInput.value.trim() === '') {
        emailError.style.display = 'inline';
        return false;
      } else if (!emailInput.value.trim().endsWith('@gmail.com')) {
        emailError.innerText = 'Please enter a valid email ending with \'@gmail.com\'.';
        emailError.style.display = 'inline';
        return false;
      } else {
        emailError.style.display = 'none';
        return true;
      }
    }
    function validatePassword() {
      var passwordInput = document.getElementById('password');
      var passwordError = document.getElementById('passwordError');

      if (passwordInput.value.trim() === '') {
        passwordError.style.display = 'inline';
        return false;
      } else {
        passwordError.style.display = 'none';
        return true;
      }
    }
    function validateConfirmPassword() {
      var passwordInput = document.getElementById('password');
      var confirmPasswordInput = document.getElementById('confirmPassword');
      var confirmPasswordError = document.getElementById('confirmPasswordError');

      if (confirmPasswordInput.value.trim() === '') {
        confirmPasswordError.style.display = 'inline';
        return false;
      } else if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordError.style.display = 'inline';
        return false;
      } else {
        confirmPasswordError.style.display = 'none';
        return true;
      }
    }
  </script>
