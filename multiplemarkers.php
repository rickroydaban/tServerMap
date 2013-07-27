<?
//must have session_start() before using sessions
session_start();

$zoomLevel=14;

//create a session that will create an array of markers
if(!isset($_SESSION['markers'])){
  $_SESSION['markers']=array();
}

//fetch all the usable data in the url passed by our java server
if(sizeof($_GET)>0){
  //a function has been called	
  $paramsCnt=sizeof($_GET)-1; //gets the number of parameters passed
  $params=array();
  //get the function name
  $functionname=$_GET['fname'];
  
  //get the arguments passed
  for($i=1;$i<=$paramsCnt;$i++){
    array_push($params,$_GET['arg'.$i]);
  }
  
  //defines the add marker function that will insert a new associative array in the marker array
  if($functionname=='addMarker'){
	$latLng = array();
    $latLng['lattitude']=$params[0];
    $latLng['longitude']=$params[1];
	array_push($_SESSION['markers'],$latLng);  
  }
  
  if($functionname=='zoomIn'){
	$zoomLevel++; 
  }
  
  if($functionname=='zoomOut'){
	$zoomLevel--;  
  }
} 
?>

<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript">
  </script>

  <script type="text/javascript">
   	function updateMapData(){
	  var dimens = getPreferredDimensions(); //retrieves the preferred dimension defined in the java server
	  var width = dimens[0]; 
	  var height = dimens[1];

      //set map dimensions in accordance to the host screen dimensions
      document.getElementById('map').style.width=width+'px';		
	  document.getElementById('map').style.height=height+'px';		
	}
	
	function test(){
	  alert("test");	
	}
</script>
</head> 
<body onLoad="updateMapData();" marginheight="0px" marginwidth="0px">
  <div id="map" style="width: 500px; height: 400px;">
  </div>

  <script type="text/javascript">	
  	var maxMarkers = 35;
      
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: <? echo $zoomLevel; ?>,
	  disableDefaultUI: true,
      center: new google.maps.LatLng(10.304109603060656, 123.91754111328123),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker;

	var jMarkers = new Array();
	jMarkers = <? echo json_encode($_SESSION['markers']) ?>;

    for(var i=0;i<jMarkers.length;i++){
	  marker = new google.maps.Marker({
        position: new google.maps.LatLng(jMarkers[i]['lattitude'], jMarkers[i]['longitude']),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>