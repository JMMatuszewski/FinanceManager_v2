<?php
    session_start();

    if(!isset($_SESSION['logged']))
    {
        header('Location: Index.php');
        exit();
    }

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
            $resultInc = $connection->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='".$_SESSION['id']."'");
           
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Something went wrong, we are sorry for inconvenience.</span>';
        echo '<br />Developer informations: '.$e;
    }


?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Add Income</title>
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
            <div class="col-sm-5"></div>
            <div class="col-sm-4">
                <div class="container d-grid p-2 row justify-content-center">
                    <h2 class="display-5 title">Add Incomes</h2>
                    <form action="AddIncAction.php" class="forms" method="post">
                        Category: <br />
                        <select class="selects" name="categoryInc">
                            <option value="none" disabled>Choose category</option>
                        <?php
                        while($row = $resultInc->fetch_assoc())
                        {
                            echo "<option value='".$row['id']."' >".$row['name']."</option>";
                        }
                        unset($row);
                        ?>
                        </select>
                        <div class="errors"></div>

                        Amount: <br />
                        <input type="text" name="amountInc" value="<?php
                        if(isset($_SESSION['m_amountInc']))
                        {
                            echo $_SESSION['m_amountInc'];
                            unset($_SESSION['m_amountInc']);
                        }
                        ?>"/><br />

                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_amountInc']))
                        {
                            echo $_SESSION['val_amount'];
                            unset($_SESSION['val_amount']);
                        }
                        ?>
                        </div>

                        Date: <br />
                        <input type="date" id="dateMax" name="dateInc" value="<?php
                        if(isset($_SESSION['m_dateInc']))
                        {
                            echo $_SESSION['m_dateInc'];
                            unset($_SESSION['m_dateInc']);
                        }
                        ?>" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_dateInc']))
                        {
                            echo $_SESSION['val_dateInc'];
                            unset($_SESSION['val_dateInc']);
                        }
                        ?>
                        </div>

                        Comment: <br />
                        <input type="text" name="commInc" value="<?php
                        if(isset($_SESSION['m_commInc']))
                        {
                            echo $_SESSION['m_commInc'];
                            unset($_SESSION['m_commInc']);
                        }
                        ?>" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_commInc']))
                        {
                            echo $_SESSION['val_commInc'];
                            unset($_SESSION['val_commInc']);
                        }
                        ?>
                        </div>
                        
                        <input type="submit" class="button" value="Add" />
                    </form>


                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </main>

    <script type="text/javascript">

      var date = new Date();
      var month = date.getMonth();
      var year = date.getUTCFullYear() - 18;
      var day = date.getDate();
      if(month < 10){
        month = "0" + month;
      }
      if(day < 10){
        day = "0" + day;
      }
      var maxDate = year + "-" + month + "-" + day;
      document.getElementById("dateMax").setAttribute("max", maxDate);
    </script>


</body>
</html>