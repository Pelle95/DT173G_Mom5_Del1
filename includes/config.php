<?php
//Startar sessionen
session_start();
//Laddar in klasser
function __autoload($class){
    include "classes/" . $class . ".class.php";
}
//Definerar variabler för databasanslutning
// define("DBHOST", "studentmysql.miun.se");
// define("DBUSER", "peek1901");
// define("DBPASS", "dbrk68ru");
// define("DBDATABASE", "peek1901");
define("DBHOST", "localhost");
define("DBUSER", "eky");
define("DBPASS", "lol123");
define("DBDATABASE", "dt173gmom5");
