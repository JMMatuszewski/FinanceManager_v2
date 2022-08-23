<?php
    session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="MainStyle.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="MainMenu.html">Finances Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navexpand">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navexpand">
                <div class="navbar-nav">
                    <a href="Index.php" class="nav-item nav-link">Main</a>
                    <a href="#" class="nav-item nav-link">Register</a>
                    <a href="#" class="nav-item nav-link">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="row">
            <div class="col-sm-5"></div>
            <div class="col-sm-4">
                <div class="container d-grid p-2 row justify-content-center">
                    <h2 class="display-5 title">Welcome!</h2>
                    <form action="RegisterAction.php" class="forms" method="post">
                        Login: <br />
                        <input type="text" class="inputs" name="username" placeholder="login" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_user']))
                        {
                            echo $_SESSION['val_user'];
                            unset($_SESSION['val_user']);
                        }
                        /*
                        if (isset($_SESSION['val_user']))
                        {
                            echo '<div class="errors">'.$_SESSION['val_user'].'</div>';
                            unset($_SESSION['val_user']);
                        }
                        */
                        ?>
                        </div>

                        Email: <br />
                        <input type="text" class="inputs" name="email" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_email']))
                        {
                            echo $_SESSION['val_email'];
                            unset($_SESSION['val_email']);
                        }
                        ?>
                        </div>

                        Password: <br />
                        <input type="password" class="inputs"name="pass" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_pass']))
                        {
                            echo $_SESSION['val_pass'];
                            unset($_SESSION['val_pass']);
                        }
                        ?>
                        </div>

                        Repeat password: <br />
                        <input type="password" class="inputs"name="ver_pass" /><br />
                        <div class="errors">
                        <?php
                        if (isset($_SESSION['val_verpass']))
                        {
                            echo $_SESSION['val_verpass'];
                            unset($_SESSION['val_verpass']);
                        }
                        ?>
                        </div>
                        
                        <input type="submit" class="button" value="Register" />
                    </form>

                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </main>


<?php
//if(isset($_SESSION['error']))	echo $_SESSION['error'];
?>
</body>
</html>