<?php
session_start();

if(isset($_POST["submit"])){
$user_otp = $_POST["OTP"];

if ($user_otp == $_SESSION["OTP"]){
    header("Location: dashboard.php");
}
}
?>



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP For The Eatey</title>
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

input[type="text"] {
  width: 100%;
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

form p{
  color: red;
  text-align: center;
}





</style>

</head>
<body>
    <form method="post" action="OTP.php">

<h1>Enter-OTP</h1>
<p>
<?php 
$info = "Your OTP Code Has Been Sent To " . $_SESSION['email']; 
echo $info;
?>
</p>
<input type="text" name="OTP" placeholder="Enter OTP Code..."/><br>

<button type="submit" name="submit">Submit</button>





    </form>
</body>
</html>