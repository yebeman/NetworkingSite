<?php 
// this input will take my localhost name
$db_host = "localhost";
// Place the username for the MySQL database here
$db_username = "yebeman"; 
// Place the password for the MySQL database here
$db_pass = "Yebelgod1"; 
// Place the name for the MySQL database here
$db_name = "messages";

// in here the program runs
@mysql_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql");
@mysql_select_db("$db_name") or die ("no database");
?>