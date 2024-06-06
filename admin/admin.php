<?php
include '../database.php';
session_start();

$message = null;
if(isset($_POST["submit"])){


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CMS</title>

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
            margin-right: 550px;
            color: chocolate;
        }

        .default_header table tr td {
            background-color: tan;
            height: 50px;
            width: 620px;
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
            width: 600px;
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
            <h2>The Eatery Database Admin</h2>
            
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
                            </tr>
                        </table>
                    </nav>
                </div>

                <div class="reservations">
                <?php
    // Prepare an SQL statement to get all reservations
    $stmt = $conn->prepare("SELECT * FROM reservations");
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Reservation Info</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone_no'] . "</td>";
            echo "<td>" . $row['reservation_info'] . "</td>";
            echo "<td><button name= 'accept'>Accept</button><br><button name= 'deny'>Deny</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No reservations found";
    }

    // Close the statement
    $stmt->close();
    ?>
                </div>
            </form>
       
    </div>
</body>

</html>