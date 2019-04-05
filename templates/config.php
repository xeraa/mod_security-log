<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', '{{ mysql_user_user }}');
define('DB_PASSWORD', '{{ mysql_user_password }}');
define('DB_NAME', '{{ mysql_database }}');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
