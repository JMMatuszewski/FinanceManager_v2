<?php
    session_start();

    if(!isset($_SESSION['logged']))
    {
        header('Location: Index.php');
        exit();
    }
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Add Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="MainStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="Index.php">Finances Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navexpand">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navexpand">
                <div class="navbar-nav">
                    <a href="UserWindow.php" class="nav-item nav-link">UserWindow</a>
                </div>
                <div class="navbar-nav">
                    <a href="Logout.php" class="nav-item nav-link">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col-lg-5">
                <?php
                //$amount = [];
                //$_SESSION['bil_on'] = false;
                    if (isset($_SESSION['amount']))
                    {
                        echo '<div class="bil" >';
                        echo '<div class="bil_text_main" >Billans:<br/>';
                        echo $_SESSION['amount'];
                        echo '</div>';
                        echo '</div>';
                        /*
                        $result = 

                        usort($myArray, function($a, $b) {
                            return $a['date_of_transaction'] <=> $b['date_of_transaction'];
                        });

                    
                    
                        //$amount = explode('|',$_SESSION['amount']);
                        echo 'amount: '.$_SESSION['amount'].'!';
                        
                        echo '<div class="bil " >';
                        foreach ($amount as $item)
                        {
                            echo 'Amount: ' . $item . '<br/>';
                            //echo 'amount: '.$_SESSION['amount'].'!';
                        }
                        echo '</div>';




                        /*
                        for($i=0 ; $i < count($amount) ; $i++)
                        {
                            echo $i;
                            echo '<br/>';
                        }
                        echo '</div>';
                        */






                        /*
                        "{$_SESSION['bil_on']}".
                        "</div>");
                        */



/*
                        echo '<script type="text/javascript">
                        alert("bil is on");
                        </script>';*/


                        //echo $_SESSION['bil_out'];
                        unset($_SESSION['amount']);
                    }
                ?>

            </div>

            <div class="col-lg-4">
                <div class="container d-grid p-2 row justify-content-center">
                    <h2 class="display-5 title">Custom Billans</h2>
                    <form action="BilAction.php" class="forms" method="post">

                        Current month:</br >
                        <input type="checkbox" id="month_bil" onchange="checkMonthBil();"/></br>

                        Start date: <br />
                        <input type="date" id="dateStart" name="dateStart"/><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_dateStart']))
                        {
                            echo $_SESSION['val_dateStart'];
                            unset($_SESSION['val_dateStart']);
                        }
                        ?>
                        </div>

                        End date: <br />
                        <input type="date" id="dateEnd" name="dateEnd" ><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_dateEnd']))
                        {
                            echo $_SESSION['val_dateEnd'];
                            unset($_SESSION['val_dateEnd']);
                        }
                        ?>
                        </div>

                        <div class="error">
                        <?php
                        if (isset($_SESSION['bilans']))
                        {
                            echo $_SESSION['bilans'];
                            unset($_SESSION['bilans']);
                        }
                        ?>
                        </div>

                        
                        <input type="submit" class="button" value="Show Bilans" />
                    </form>


                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </main>

    <script type="text/javascript">

        var date = new Date();
        var month = date.getMonth()+1;
        var year = date.getUTCFullYear();
        var day = date.getDate();
        if(month < 10){
            month = "0" + month;
        }
        if(day < 10){
            day = "0" + day;
        }
        var maxDate = year + "-" + month + "-" + day;
        document.getElementById("dateStart").setAttribute("max", maxDate);
        document.getElementById("dateEnd").setAttribute("max", maxDate);
      
        // Current Month Billans //

        var monthStart = year + "-" + month + "-" + "01";
        
        function checkMonthBil(){
            if (document.getElementById('month_bil').checked == true)
            {
                document.getElementById("dateStart").setAttribute("value", monthStart);
                document.getElementById("dateEnd").setAttribute("value", maxDate);
            }
            else{
                document.getElementById("dateStart").removeAttribute("value");
                document.getElementById("dateEnd").removeAttribute("value");
            }
        }

        // End of Current Month Billans //
    </script>


</body>
</html>