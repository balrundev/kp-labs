<?php
$dbloc = 'localhost';
$dbuser = 'admin';
$dbpass = 'dbserver04';
$dbname = 'user1';
$dsn = "mysql:host={$dbloc};dbname={$dbname}";
return new PDO($dsn, $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>