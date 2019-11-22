<?php
  include_once "lib/db.php";
  include "lib/sql_form.php";
  
  if(!$_GET['id'])
    $_GET['id'] = str_replace("/", "", $_SERVER['PATH_INFO']);
  $query = "SELECT * FROM listings WHERE id = ".$_GET['id'];
  $result = mysql_query($query);
  $line = mysql_fetch_array($result, MYSQL_ASSOC);
  if($line['status'] == "DELETED"){ print("This file is deleted."); exit;} 
 
  $_POST['form_id'] = $line['form_id'];
  $_POST['fields'] = split(",", $line['fields']);
  excel_report_results();
?>
