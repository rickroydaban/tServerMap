<?
if(sizeof($_GET)>0){
  //a function has been called	
  $paramsCnt=sizeof($_GET)-1; //gets the number of parameters passed

  $params=array();
  $functionname=$_GET['fname'];
  
  for($i=1;$i<=$paramsCnt;$i++){
      array_push($params,$_GET['arg'.$i]);
  }
	
  
  mysql_connect("localhost", "root", "");
  mysql_select_db("transphone");
  
  if($functionname == 'getPlateNumberList'){
    $plateNumbers = array();	
	$getPlateNoQuery = mysql_query("SELECT * FROM taxi");

    while($row=mysql_fetch_array($getPlateNoQuery)){
      $taxiInfo=array();
	  $taxiInfo["plateNo"]=$row["plateNo"];
	  $taxiInfo["password"]=$row["password"];
	  $taxiInfo["bodyNo"]=$row["bodyNo"];
	  $taxiInfo["driver"]=$row["driver"];
	  $taxiInfo["company"]=$row["company"];


	  array_push($plateNumbers,$taxiInfo);
	}
    echo json_encode($plateNumbers);	  
  }
  
}else
  echo "no function defined";
?>