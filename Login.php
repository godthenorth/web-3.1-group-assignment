<?php
include 'database.php';
$message = null;
if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare a SELECT statement to get the user with the entered email
    $stmt = $conn->prepare("SELECT * FROM clients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // User exists, now we verify the password
        $user = $result->fetch_assoc();
        if($user['password'] === $password){
            // Passwords match
            header("Location: dashboard.php");
        } else {
            // Passwords don't match
            $message = "Invalid password!";
        }
    } else {
        // User doesn't exist
        $message = "Invalid email!";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f0f0f0;
  display: flex;
  justify-content: flex-start; 
  align-items: center; 
  height: 100vh; 
  background-image: url("https://www.melissahartfiel.com/wp-content/uploads/2013/04/20130426-1304_untitled005.jpg");

}
form {
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  background-image: url("https://www.thenottinghamshire.com/wp-content/uploads/2022/04/NOTTINGHAMSHIRE-BURGER-NEW-2000x0-c-default.jpg");
}


h1 {
  text-align: center;
  color: #333;
}

label {
  
  margin-bottom: 5px;
}

input[type="text"], input[type="password"] {
  width: 90%;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  color: white;
  background-color: tan;
  cursor: pointer;
}

button:hover {
  background-color: chocolate;

}

form p, a{
  color: red;
  text-align: center;
}

    </style>

</head>


<body>
    

    <form action="Login.php" method="post">

<h1>Login</h1>

<p><?php echo $message;?></p>
<label>Email</label><br>
<input type="text" name="email"/><br>


<label>Password</label><br>
<input type="password" name="password"/><br>

<button action="submit" name="submit">Login</button>
<p>New here? <a href="./registration.php">Sign Up</a></p>

    </form>
</body>
</html>



