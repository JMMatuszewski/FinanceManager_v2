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
	<title>Personal Finances</title>
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
                    <a href="Logout.php" class="nav-item nav-link">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-4">
                <div class="container d-grid p-2">
                    <h2 class="display-5 text-center fw-bold text-info">Personal Finances</h2>
                    <div class="row justify-content-center p-3"><a href="AddExpWindow.php" type="button"
                            class="button btn-outline-info">Add Expense</a>
                    </div>
                    <div class="errors"></div>

                    <div class="row justify-content-center p-3"><a href="AddIncWindow.php" type="button"
                            class="button btn-outline-info">Add Income</a>
                    </div>
                    <div class="errors"></div>

					<div class="row justify-content-center p-3"><a href="BilWindow.php" type="button"
                            class="button btn-outline-info">Show Bilans</a>
                    </div>
                    <div class="errors"></div>

                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </main>
</body>
</html>
