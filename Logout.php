<?php

    session_start();

    session_unset();

    header('Location: Index.php');
?>