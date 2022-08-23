<?php

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
    else
	{
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $username = htmlentities($username, ENT_QUOTES, "UTF-8");

		if ($result = @$connection->query(
		sprintf("SELECT * FROM users WHERE username='%s'",
		mysqli_real_escape_string($connection,$username))))
		{
            $existingUsers = $result->num_rows;
            if($existingUsers>0)
            {
                $row = $result->fetch_assoc();

                if(password_verify($pass, $row['password']))
                {
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    unset($_SESSION['error']);
                    $result->free_result();
                    
                    header('Location: UserWindow.php');
                }
                else
                {
                    $_SESSION['error'] = '<span style="color:red">Wrong login or password</span>';
                    header('Location: LoginWindow.php');
                }

            }
            else
            {
                $_SESSION['error'] = '<span style="color:red">Wrong login or password</span>';
                header('Location: LoginWindow.php');
            }
        }

        $connection->close();
    }
?>