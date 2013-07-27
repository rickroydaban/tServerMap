<?php

namespace db{

function connectDB($host, $username, $password, $dbname){
  if(@mysql_connect($host, $username, $password)){
    if(@mysql_select_db($dbname)){
      return true;	
	}
  }
  
  return false;  
}

function getPlateNumberList(){
  $plateNumbers = array();	
	
  while($row=mysql_fetch_array(mysql_query("SELECT * FROM taxi")))
    array_push($plateNumbers,$row['plateNo']);

  return $plateNumbers;
}
}

?>