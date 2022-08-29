<?php
    session_start();

    if(isset($_POST['categoryExp']))
    {
        // VALIDATION //
        $valid = true;

        $userId = $_SESSION['id'];
        $expCat = $_POST['categoryExp'];
        $payCat = $_POST['payment'];
        $amount = $_POST['amountExp'];
        $dateExp = $_POST['dateExp'];
        $commExp = $_POST['commExp'];

        // amount //
        if(!preg_match("/^(\d{1,8}(\.\d{1,2})?)$/",$amount))
        {
            $valid = false;
            $_SESSION['val_amountExp']="Wrong currency format: 1-8 dd or 1-8 dd.dd";
        }

        $_SESSION['m_amountExp'] = $_POST['amountExp'];
        $_SESSION['m_commExp'] = $_POST['commExp'];

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
                    
                    if($connection->query("INSERT INTO expenses VALUE (NULL, '$userId','$expCat','$payCat','$amount','$dateExp','$commExp')"))
                    {
                        unset($_SESSION['m_amountExp']);
                        unset($_SESSION['m_commExp']);


                        echo '<script type="text/javascript">
                        alert("Expense has been added");
                        window.location.href="UserWindow.php";
                        </script>';

                        //header('Location: UserWindow.php');
                    }

                }
                else
                {
                    header('Location: AddExpWindow.php');
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




/*
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
                $result = $connection->query("SELECT * FROM expenses_category_assigned_to_users");
                
                while($row = $result->fetch_assoc())
                {
                    
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








/*
    if(isset($_POST['username']))
    {
    }
*/

?>