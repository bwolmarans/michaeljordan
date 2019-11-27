<?php
// **** add HTTP Strict Transport Security header 
// **** ( this makes sure the browser will use SSL for this page
header("strict-transport-security: max-age=600");
include_once "lib/db.php";
include "lib/sql_form.php";

if(!$_GET['id']) {
	$_GET['id'] = str_replace("/", "", $_SERVER['PATH_INFO']);
	// ***********************
	// * parameterize the id *
	// ***********************
	$myid = $_GET['id'];
	$myparams = array($myid); 
	$my_parameterized_query = 'SELECT * FROM listings WHERE id = (myid)';
	//$query = "SELECT * FROM listings WHERE id = ".$_GET['id'];
	// ***********************
	// * make the call and pass in the parameters
	// ***********************
	$result = $conn->query($my_parameterized_query);
	//$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$line = $result;
}
if($line['status'] == "DELETED"){ print("This file is deleted."); exit;} 
$_POST['form_id'] = $line['form_id'];
$_POST['fields'] = split(",", $line['fields']);
excel_report_results();
?>
