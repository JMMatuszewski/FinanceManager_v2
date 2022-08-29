<?php
    session_start();

    if(isset($_POST['categoryInc']))
    {
        // VALIDATION //
        $valid = true;

        $userId = $_SESSION['id'];
        $incCat = $_POST['categoryInc'];
        $amountInc = $_POST['amountInc'];
        $dateInc = $_POST['dateInc'];
        $commInc = $_POST['commInc'];

        // amount //
        if(!preg_match("/^(\d{1,8}(\.\d{1,2})?)$/",$amountInc))
        {
            $valid = false;
            $_SESSION['val_amountInc']="Wrong currency format: 1-8 dd or 1-8 dd.dd";
        }

        $_SESSION['m_amountInc'] = $_POST['amountInc'];
        $_SESSION['m_commInc'] = $_POST['commInc'];

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
                if($valid)
                {
                    
                    if($connection->query("INSERT INTO incomes VALUE (NULL, '$userId','$incCat','$amountInc','$dateInc','$commInc')"))
                    {
                        unset($_SESSION['m_amountInc']);
                        unset($_SESSION['m_commInc']);


                        echo '<script type="text/javascript">
                        alert("Income has been added");
                        window.location.href="UserWindow.php";
                        </script>';

                        //header('Location: UserWindow.php');
                    }

                }
                else
                {
                    header('Location: AddIncWindow.php');
                }



                $connection->close();
            }



        }
        catch(Exception $e)
        {
			echo '<span style="color:red;">Something went wrong, we are sorry for inconvenience.</span>';
			echo '<br />Developer informations: '.$e;
		}
    }

?>