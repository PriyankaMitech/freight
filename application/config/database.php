<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'mitech_freight',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
// Initialise
$conn = null;
// try {
//     // Database connection
//     $pdoObj = new PDO("sqlsrv:Server={$dsn};Database={$db};", $user, $pass);
//     if(is_object($pdoObj)){
//       echo 'Connection established successfully.';
//     }
// print_r($dsn);
// }
// catch(PDOException $pe){
//     // Throw exception
//     echo 'Critical Error: Unable to connect to Database Server because: '.$pe->getMessage();
// }
// var_dump(extension_loaded ("php_sqlsrv_74_ts"));

// $serverName = "DESKTOP-GJAKU980";

// $connectionOptions = array("Database" => "testdb", 

//                            "UID" => "sa",

//                            "PWD" => "sql@123");

// $conn = sqlsrv_connect($serverName, $connectionOptions);



// if($conn === false)

// {

//     die(print_r(sqlsrv_errors(), true));

// }
// phpinfo();
// $serverName = "DESKTOP-GJAKU98";
// $connectionOptions = array("Database" => "testdb",
//     "UID" => "",
//     "PWD" => "");
// $conn = sqlsrv_connect($serverName, $connectionOptions);

// if ($conn === false) {
//     die(print_r(sqlsrv_errors(), true));
// }

// echo '<pre>';
//   print_r($db['default']);
//   echo '</pre>';

//   echo 'Connecting to database: ' .$db['default']['database'];
//   $dbh=mysqli_connect(
//     $db['default']['hostname'],
//     $db['default']['username'],
//     $db['default']['password']
//   )
//     or die('Cannot connect to the database because: ' . mysqli_error());
//     mysqli_select_db ($db['default']['database']);

//     echo '<br />   Connected OK:'  ;
//     die( 'file: ' .__FILE__ . ' Line: ' .__LINE__); 
