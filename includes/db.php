<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'project_klook';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);
$mysqli->set_charset('utf8');
?>