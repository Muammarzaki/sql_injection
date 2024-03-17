<?php

if (isset($_GET['option'])) {
    $con = mysqli_connect('mysql', 'root', 'secret', 'sql_inject');
    $id = $_GET['id'];
    $option = $_GET['option'];

    if ($option == 'delete') {
        $query = "DELETE FROM account WHERE id = '" . $id . "'";
        $affected = mysqli_query($con, $query);
        var_dump($affected);
        echo "<script>
        window.location.href='list_user.php';
        console.log(true);
        </script>";
    }

    if ($option == 'update') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "UPDATE account SET username = '$username', password = '$password' WHERE id = '$id'";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<script>alert('User updated successfully');</script>";
                echo "<script>window.location.href='list_user.php';</script>";
            } else {
                echo "<script>alert('Failed to update user');</script>";
            }
        } else {
            // Retrieve existing user information
            $query = "SELECT username, password FROM account WHERE id = '$id'";
            $result = mysqli_query($con, $query);
            $user = mysqli_fetch_assoc($result);

?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update User</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }

                    .container {
                        width: 50%;
                        margin: 50px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    h1 {
                        text-align: center;
                    }

                    form {
                        max-width: 400px;
                        margin: 0 auto;
                    }

                    label {
                        display: block;
                        margin-bottom: 5px;
                    }

                    input[type="text"],
                    input[type="password"] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        box-sizing: border-box;
                    }

                    input[type="submit"] {
                        width: 100%;
                        background-color: #007bff;
                        color: #fff;
                        padding: 10px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s;
                    }

                    input[type="submit"]:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>

            <body>
                <div class="container">
                    <h1>Update User</h1>
                    <form method="post">
                        <input type="hidden" name="option" value="update">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>">
                        <input type="submit" value="Update">
                    </form>
                </div>
            </body>

            </html>
<?php
        }
    }
}
?>