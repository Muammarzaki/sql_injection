<?php
session_start();
if (!isset($_SESSION['PHISSION'])) {
    echo "<script>
    window.location.href = 'slogin.php' 
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #da190b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User Accounts</h1>
        <a href="logout.php?unsecure=true" class="logout-btn">UNSECURE LOGOUT</a>
        <a href="logout.php?secure=true" class="logout-btn">SECURE LOGOUT</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <?php if ($_SESSION['ROLE'] == 'ADMIN') : ?>
                        <th>ROLE</th>
                        <th>ACTION</th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = mysqli_connect('mysql', 'root', 'secret', 'sql_inject');
                $result = mysqli_query($con, "SELECT id, username, password, role FROM account");
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($_SESSION['ROLE'] == 'ADMIN') {
                        echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['password'] . '</td>
                    <td>' . $row['role'] . '</td>
                    <td>
                        <a href="modify.php?id=' . $row['id'] . '&option=update">Edit</a>
                        <a href="modify.php?id=' . $row['id'] . '&option=delete">Delete</a>
                    </td>
                    </tr>';
                    }
                    if ($_SESSION['ROLE'] == 'USER') {
                        echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['password'] . '</td>
                    </tr>';
                    }
                }
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>