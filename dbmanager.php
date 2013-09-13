<?php
 
if(sizeof($_GET)>0){
  //a function has been called	
  $paramsCnt=sizeof($_GET)-1; //gets the number of parameters passed

  $params=array();
  $functionname=$_GET['fname'];
  
  for($i=1;$i<=$paramsCnt;$i++){
      array_push($params,$_GET['arg'.$i]);
  }
	
  
  mysql_connect("localhost", "586702", "4graduation");
  mysql_select_db("586702");
  
  if($functionname == 'getCompanies'){
  	$companies = array();
    $query = mysql_query("SELECT * FROM company");
  	while($row = mysql_fetch_assoc($query)){
  		$compInfo['id'] = $row['id'];
  		$compInfo['name'] = $row['name'];
  		$compInfo['password'] = $row['password'];
  		$compInfo['contact'] = $row['contact'];
  		$compInfo['serverip'] = $row['serverip'];

  		array_push($companies, $compInfo);
		}
    echo json_encode($companies);	  
  }

  
  if($functionname == 'getTaxiInfos'){
  	$compID = $params[0];
    $taxis = array();	
    $query = mysql_query("SELECT * FROM taxi WHERE company='$compID'");

    while($row=mysql_fetch_array($query)){
		  $taxiInfo["plateNo"]=$row["plateNo"];
	  	$taxiInfo["bodyNo"]=$row["bodyNo"];
		  $taxiInfo["description"]=$row["description"];

	  	array_push($taxis,$taxiInfo);
		}
    echo json_encode($taxis);	  
  }
  
  if($functionname == 'getDriverInfos'){
  	$compID = $params[0];
    $drivers = array();	
		$getDriverQuery = mysql_query("SELECT * FROM driver WHERE company='$compID'");

    while($row=mysql_fetch_array($getDriverQuery)){
		  $driverInfo["name"]=$row["name"];
	  	$driverInfo["license"]=$row["license"];
	  	$driverInfo["password"]=$row["password"];

	  	array_push($drivers,$driverInfo);
		}
    echo json_encode($drivers);	  
  }  
  
  if($functionname == 'setServerIP'){
    $ip = $params[0];

    if(mysql_query("UPDATE company SET serverip='$ip'"))
      echo true;
    else
      echo mysql_error();
  }

  if($functionname == 'registerDriver'){
		$license = $params[0];
		$plateNo = $params[1];
		
		if(mysql_query("INSERT INTO taxidriver(`driver`,`plateNo`) VALUES('$license','$plateNo')"))  
	  	echo 1;
		else 
	  	echo mysql_error();
  }
}else
  echo "no function defined";
?>