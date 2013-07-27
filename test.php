<?

if(sizeof($_GET)>0){
  //a function has been called	
  $paramsCnt=sizeof($_GET)-1; //gets the number of parameters passed

  $params=array();
  $functionname=$_GET['fname'];
  
  for($i=1;$i<=$paramsCnt;$i++){
    array_push($params,$_GET['params'.$i]);
  }
	
  switch($paramsCnt){
	case 0:
	   $result=$functionname();
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 

	   break;
		   
	case 1:
	   $result=$functionname($_GET['arg1']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;

	case 2:
	   $result=$functionname($_GET['arg1'],$_GET['arg2']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;
	   
  	case 3:
	   $result=$functionname($_GET['arg1'],$_GET['arg2'],$_GET['arg3']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;

	case 4:
	   $result=$functionname($_GET['arg1'],$_GET['arg2'],$_GET['arg3'],$_GET['arg4']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;
	
	case 5:
	   $result=$functionname($_GET['arg1'],$_GET['arg2'],$_GET['arg3'],$_GET['arg4'],$_GET['arg5']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;

	case 6:
	   $result=$functionname($_GET['arg1'],$_GET['arg2'],$_GET['arg3'],$_GET['arg4'],$_GET['arg5'],$_GET['arg6']);
	   if(is_array($result))
	     json_encode($result);
	   else
	     echo "the result is boolean";	 
		 
	   break;

	default:
	  break;
  }
}else
  echo "the function does not exist";
?>