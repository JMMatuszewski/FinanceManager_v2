<?php
    session_start();

    if(isset($_POST['username']))
    {

        // VALIDATION //

        $valid = true;
        //username
        $username = $_POST['username'];
        if((strlen($username) < 6) || (strlen($username) > 20))
        {
            $valid = false;
            $_SESSION['val_user']="Login must be between 6 and 20 characters.";
        }

        if(ctype_alnum($username)==false)
        {
            $valid = false;
            $_SESSION['val_user']="Login can only contain letters or numbers.";
        }

        //email
        $email = $_POST['email'];
        $filtered_email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($filtered_email, FILTER_VALIDATE_EMAIL)==false) || ($filtered_email!=$email))
		{
            $valid = false;
            $_SESSION['val_email']="Wrong email structure.";
        }


        //password
        $password = $_POST['pass'];
        $ver_password = $_POST['ver_pass'];

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) < 6 || strlen($password) > 50 || 
        !$uppercase || !$lowercase || !$number || !$specialChars)
        {
            $valid = false;
            $_SESSION['val_pass']="Incorrect password.";
        }

        if($password != $ver_password)
        {
            $valid = false;
            $_SESSION['val_verpass']="Passwords does not match.";
        }

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

        try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
                //Check Username duplicate
                $result=$connection->query("SELECT id FROM users WHERE username='$username'");

                if(!$result) throw new Exeption($connection->error);

                $user_duplic = $result->num_rows;
                if($user_duplic > 0)
                {
                    $valid = false;
                    $_SESSION['val_user'] = "Username already exists.";
                }

                //Check Email duplicate
                $result=$connection->query("SELECT id FROM users WHERE email='$email'");

                if(!$result) throw new Exeption($connection->error);

                $email_duplic = $result->num_rows;
                if($email_duplic > 0)
                {
                    $valid = false;
                    $_SESSION['val_email'] = "There is already account with that Email.";
                }

                if($valid == true)
                {
                    if($connection->query("INSERT INTO users VALUES (NULL, '$username', '$pass_hash', '$email')"))
                    {
                        echo '<script type="text/javascript">
                        alert("Thank You for registration ' . $username .'");
                        window.location.href="Index.php";
                        </script>';
                    }


                }
                else
                {
                    header('Location: RegisterWindow.php');
                }

                $polaczenie->close();
            }
        }
        catch(Exception $e)
        {
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}






    }



?>
