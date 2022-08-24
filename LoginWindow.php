<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>LoginWin</title>
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
                    <a href="Index.php" class="nav-item nav-link">Main</a>
                    <a href="RegisterWindow.php" class="nav-item nav-link">Register</a>
                    <a href="LoginWindow.php" class="nav-item nav-link">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-4">
                <div class="container d-grid p-2 row justify-content-center">
                    <h2 class="display-5 title">Welcome Back!</h2>
                    <form action="LoginAction.php" class="forms" method="post">
                        Login: <br />
                        <input type="text" class="inputs" name="username" placeholder="login" /><br />
                        Password: <br />
                        <input type="password" class="inputs"name="pass" placeholder="password" /><br />
                        <input type="submit" class="button" value="Login" />
                    </form>

                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </main>

<?php
if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>
</body>
</html>
