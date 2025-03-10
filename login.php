<?php
session_start();
require_once "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $sql = "SELECT id FROM users WHERE email = ? AND password = ?";
  if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("ss", $email, $password);
    if ($stmt->execute()) {
      $stmt->store_result();
      if ($stmt->num_rows == 1) {
        $_SESSION["email"] = $email;
        $_SESSION["loggedin"] = true;
        header("location: Dashboard/index2.html");
      } else {
        $login_err = 'Incorrect Email or Password, Please try again';
      }
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }
    $stmt->close();
  }
  $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login-signup-style.css">
</head>

<body>
  <div class="back">
    <div class="back-btn">
      <h2><a href="Dashboard/index.html">BACK TO HOME</a></h2>
    </div>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
    <h2>Login</h2>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" onblur="validateEmail()"><br>
    <span id="emailError" class="error">Please enter a valid email ending with '@gmail.com'.</span><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" onblur="validatePassword()"><br>
    <span id="passwordError" class="error">Please enter a valid password.</span><br>
    <?php if (isset($login_err))
      echo "<p>$login_err</p>"; ?>
    <input type="submit" value="Login">
    <div class="footer">
      <p>Don't have an account? <a href="signup.php">SIGNUP NOW</a></p>
    </div>
  </form>
</body>

</html>
<script>
  function validateForm() {
    var isValid = true;
    if (!validateEmail()) {
      isValid = false;
    }
    if (!validatePassword()) {
      isValid = false;
    }
    return isValid;
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
</script>
