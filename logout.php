<?php 
session_start();

unset($_SESSION["ses_id_user"]);
unset($_SESSION["ses_nama"]);


header("location:./login.php");

?>