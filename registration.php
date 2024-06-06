<?php
include 'database.php';

$message = ""; // Initialise message variable

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $password= $_POST["password"];
    $security = $_POST["security"];

    // Check if password and security match
    if($password !== $security){
        $message = "Passwords do not match!";
    } else {
        // Prepare a SELECT statement to check for duplicate email and phone number
        $stmt = $conn->prepare("SELECT * FROM clients WHERE email = ? OR phone_no = ?");
        $stmt->bind_param("ss", $email, $number);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $message = "Email or phone number already exists!";
        } else {
            // Prepare an SQL statement
            $stmt = $conn->prepare("INSERT INTO clients (name, surname, email, phone_no, password, join_date) VALUES (?, ?, ?, ?, ?, NOW())");

            // Bind parameters
            $stmt->bind_param("sssss", $name, $surname, $email, $number, $password);

            // Execute the statement
            if ($stmt->execute()) {
                session_start();
                $_SESSION["email"] = $email;
                $_SESSION['name'] = $name;
                $_SESSION['number'] = $number;

                

                $otp = rand(100000,999999); // Generate random OTP

    $_SESSION["OTP"] = $otp; // Store OTP in session

    $to_email = $_SESSION["email"];
    $subject = "Your OTP Code";
    $body = "Dear $name,

Welcome to our community @The Eatery! We're excited to have you on board.

As part of the registration process, we need to verify your email address. Your One-Time Password (OTP) is: " . $otp . "

Please enter this OTP in the provided field to complete your registration.

If you did not request this code, please ignore this email or contact us immediately.

Thank you for joining us!

Best Regards,
The Team";

    $headers = "From: godthenorth@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
      header("Location: OTP.php");
    } else {
        echo "Email sending failed...";
    }

            } else {
                $message = "Error: " . $stmt . "<br>" . $conn->error;
            }
        }

        // Close the statement
        $stmt->close();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
<style>

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f0f0f0;
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

input[type="text"], input[type="email"], input[type="password"] {
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

    <form action="registration.php" method="post">

    <h1>The Eatery</h1>

    <p><?php echo $message;?></p>

    <label>Name</label><br>
        <input type="text" name="name" /><br>

        <label>Surname</label><br>
        <input type="text" name="surname" /><br>

        <label>Email Address</label><br>
        <input type="email" name="email" /><br>

        <label>Phone Number</label><br>
        <input type="text" name="number" /><br>

        <label>Password</label><br>
        <input type="password" name="password" /><br>

        <label>Verify Password</label><br>
        <input type="password" name="security" /><br>


        <button type="submit" name="submit">Register</button><br>
        <p>Already have an account? <a href="./Login.php">Login</a></p>

    


    </form>
</body>
</html>

