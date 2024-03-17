<?php session_start(); ?>
<?php
if (isset($_POST['submit'])) {

    $con = mysqli_connect('mysql', 'root', 'secret', 'sql_inject');

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT username,role FROM account WHERE username='" . $username . "' AND password='" . $password . "';";

    $find = mysqli_query($con, $query);
    if ($find != false) {
        $find_assoc = mysqli_fetch_row($find);

        if ($find->num_rows > 0) {
            $message = 'anda berhasil login sebagai <strong>' . $find_assoc[0] . '<strong>';
            $_SESSION['PHISSION'] = uniqid();
            $_SESSION['ROLE'] = $find_assoc[1];
        } else {
            $message =  'anda gagal login';
        }
    } else {
        $message = "Error: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            width: 800px;
            max-width: 90%;
        }

        .login-form {
            flex: 1;
            padding: 40px;
        }

        .sql-query {
            flex: 1;
            background-color: #f5f5f5;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #666666;
        }

        .sql-query textarea {
            width: 100%;
            height: 300px;
            resize: none;
            border: none;
            background-color: #f5f5f5;
            color: #666666;
            font-family: monospace;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            cursor: pointer;
            margin-right: 10px;
            /* Margin added to separate buttons */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .list-user-btn {
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            cursor: pointer;
            text-decoration: none;
        }

        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
        }

        .list-user-btn:hover {
            background-color: #0b7dda;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="center-box">
            <div class="login-form">
                <h2><a href="uslogin.php">Secure Login</a></h2>
                <form action="" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" name="username" id="username" autocomplete="off"><br>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password"><br>
                    <input type="submit" name="submit" value="Submit">
                    <?php if (isset($_SESSION['PHISSION'])) : ?>
                        <a href="list_user.php" class="list-user-btn">List User</a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="sql-query">
                <h2>SQL Query</h2>
                <?php
                echo '<textarea readonly>';
                echo htmlspecialchars($query);
                echo '</textarea>';
                echo $message;
                ?>
            </div>
        </div>
    </div>
    <script>
        console.log("<?= $username . " " . $username ?>")
    </script>
</body>

</html>