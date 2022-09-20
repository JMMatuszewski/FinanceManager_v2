<?php
    session_start();

    if(isset($_POST['dateStart']))
    {
        // VALIDATION //
        $id = $_SESSION['id'];
        $dateStart = $_POST['dateStart'];
        $dateEnd = $_POST['dateEnd'];

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

                //'".$_SESSION['id']."'


                //$resultExp = $connection->query("SELECT * FROM expenses WHERE user_id=$id");

                $resultExp = $connection->query("SELECT * FROM expenses WHERE user_id=$id 
                AND date_of_transaction >='".$dateStart."' AND date_of_transaction <='".$dateEnd."'");
                $resultInc = $connection->query("SELECT * FROM incomes WHERE user_id=$id 
                AND date_of_transaction >='".$dateStart."' AND date_of_transaction <= '".$dateEnd."'");

                $sum=0;
                unset($_SESSION['amount']);
                //$amount = [];
                //$comment = [];

                $_SESSION['ExpArrays'] = $resultExp;
                $_SESSION['IncArrays'] = $resultInc;

                
                while($rowInc = $resultInc->fetch_assoc())
                {
                    $sum += $rowInc['amount'];
                    //$amount[] = $rowInc['amount'];
                    //$IncArray = implode('|', $rowInc);
                    //$amount[] = $rowInc;
                    //$comment[] = $rowInc['income_comment'];
                }
                
                $counter = "text";
                while($rowExp = $resultExp->fetch_assoc())
                {
                    $sum += $rowExp['amount'];
                    //$amount[] = $rowExp['amount'];
                    //$amount[] = $counter;
                    //$comment[] = $rowExp['expense_comment'];
                }
                /*
                for($i=0 ; $i < count($amount) ; $i++)
                {
                    echo $i;
                }
                */

                //usort($amount, 'date_compare');




                $_SESSION['bil_on'] = true;
                //$_SESSION['rowInc'] = $resultInc;
                //$qrwa = implode('|', $amount);
                $_SESSION['amount'] = $sum;
                
                /*
                $version = phpversion();
                
                echo '<script type="text/javascript">
                alert("sum: '.$version.'  start: '.$dateStart.'");
                
                </script>';
                //window.location.href="BilWindow.php";

                //$_SESSION['bilans'] = $sum;
                /*
                $rowExp = $resultExp->fetch_assoc();
                    echo '<script type="text/javascript">
                    alert("sum: '.$rowExp['amount'].'");
                    window.location.href="BilWindow.php";
                    </script>';
                /*
                echo '<script type="text/javascript">
                window.location.href="BilWindow.php";
                </script>';
                */


                header("Location: BilWindow.php");
                




                $connection->close();
            }



        }
        catch(Exception $e)
        {
			echo '<span style="color:red;">Something went wrong, we are sorry for inconvenience.</span>';
			echo '<br />Developer informations: '.$e;
		}
    }

    // Comparison function
    function date_compare($element1, $element2) 
    {
        $datetime1 = strtotime($element1['date_of_transaction']);
        $datetime2 = strtotime($element2['date_of_transaction']);
        return $datetime1 - $datetime2;
    } 


?>