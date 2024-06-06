<?php
include 'database.php';
session_start();

$message = null;
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $num_people = $_POST["num_people"];

    // Create reservation info paragraph
    $reservation_info = "Reserve date: " . $date . ", time: " . $time . ", for " . $num_people . " people.";

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone_no, reservation_info) VALUES (?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $reservation_info);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "New reservation created successfully";
    } else {
        $message = "Error: " . $stmt . "<br>" . $conn->error;
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
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            scroll-behavior: smooth;
        }

        header {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: tan;
            color: white;
        }

        header .left {
            width: 5px;
        }

        header .right ul {
            list-style-type: none;
        }

        header .right ul li a {
            color: white;
            text-decoration: none;
        }

        .nav {
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            height: 93.5vh;
            background-color: tan;
            color: white;
            padding: 20px;
            border: black solid 1px;
            border-radius: 5px;
        }


        .nav a {
            color: white;
            text-decoration: none;
        }

        .nav ul {
            list-style-type: none;
        }

        .title h2 {
            position: absolute;
            top: 2%;
            left: 0;
            transform: translateY(-50%);
            padding-left: 10px;
            /* Adjust this value as needed */
            text-align: center;
            margin-left: 40px;
        }


        input[type="text"],
        input[type="date"],
        input[type="email"],
        select,
        input[type="number"] {
            width: 290px;
            /* Adjust this value as needed */
            padding: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100px;
            /* Adjust this value as needed */
            padding: 5px;
            border: 1px solid #ccc;
            background-color: tan;
            color: white;

        }


        .content_area {
            display: flex;
            justify-content: flex-end;
            height: 87.4vh;
            background-color: #f0f0f0;
            border: black solid 1px;
        }

        .inversed_nav {
            display: flex;
            flex-direction: column;
            height: 87.4vh;
            overflow-y: auto;
            background-color: #fff;
            padding: 10px;
            border-left: 1px solid #ccc;
        }

        .message_input {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 90%;
            width: 300px;
            height: 50px;
            background-color: #fff;
            padding: 10px;
        }



        .message_input textarea {
            width: 80%;
            height: 100%;
        }

        .message_input button {
            width: 15%;
            height: 100%;
        }

        .general h2 {
            text-align: center;
            margin-right: 250px;
            color: chocolate;
        }

        .default_header table tr td {
            background-color: tan;
            height: 50px;
            width: 160px;
            text-align: center;

        }

        .default_header table tr td a {
            color: white;
        }

        .menu_option {}

        a {
            text-decoration: none;
        }

        .reservations {
            border: tan solid 1px;
            width: 307px;
            padding: 10px;
        }

        .reservations .center {
            display: flex;
            justify-content: center;
            margin: 15px;
        }
    </style>
</head>

<body>
    <header>
        <div class="left">

            <h3>Welcome</h3>
        </div>

        <div class="right">
            <ul>
                <li><a href=""><i class="fas fa-user"></i></a></li>

            </ul>
        </div>
    </header>

    <div class="nav">
        <div class="title">
            <h2>The Eatery</h2>
        </div>
        <nav>
            <div class="item">
                <ul>
                    <li><a href=""><i class="fas fa-home"></i> Home</a></li>
                </ul>
            </div>

            <div class="item">
                <ul>
                    <li><a href=""><i class="fas fa-bullhorn"></i> Announcements</a></li>
                </ul>
            </div>

            <div class="item">
                <ul>
                    <li><a href=""><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>

        </nav>
    </div>

    <div class="content_area">
        <div class="general">
            <h2>Welcome To The Eatery</h2>
            
            <form action="dashboard.php" method="post">
            <p><?php echo $message;?></p>
                <div class="default_header">
                    <nav>
                        <table>
                            <tr>
                                <td>
                                    <div class="menu_option">
                                        <a href="">Reservations</a>
                                    </div>
                                </td>

                                <td>
                                    <div class="menu_option">
                                        <a href="">Orders</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </nav>
                </div>

                <div class="reservations">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['name'];?>"><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'];?>"><br>

                    <label for="phone">Phone:</label><br>
                    <input type="text" id="phone" name="phone" value="<?php echo $_SESSION['number'];?>"><br>

                    <label for="date">Date:</label><br>
                    <input type="date" id="date" name="date" required><br>

                    <label for="time">Time:</label><br>
                    <select id="time" name="time" required>
                        <option value="12:00">12:00 PM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="14:00">2:00 PM</option>
                        <option value="16:00">4:00 PM</option>
                        <option value="19:00">7:00 PM</option>
                        <option value="20:30">8:30 PM</option>
                    </select><br>

                    <label for="num_people">Number of People:</label><br>
                    <input type="number" id="num_people" name="num_people" required><br>

                    <div class="center">
                        <input type="submit" value="Reserve Table" name="submit">
                    </div>

                </div>
            </form>
        </div>
        <div class="inversed_nav">
            <!--Chat Area -->
        </div>
        <div class="message_input">
            <textarea rows="6" cols="85" placeholder="Type a message..."></textarea>
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</body>

</html>