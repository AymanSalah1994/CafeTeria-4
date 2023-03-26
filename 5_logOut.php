<?php
session_start();
// EVEN to Destropy the Session , you have to start it First 
session_destroy();
header("Location: 3_loginForm.php");
exit();