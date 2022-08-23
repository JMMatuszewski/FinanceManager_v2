<?php

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
    else
	{
        $login = $_POST['login'];
        $haslo = $_POST['pass'];

        echo "we are logged";

        $polaczenie->close();
    }
?>