<?
//must have session_start() before using sessions
session_start();

$_SESSION['zoomLevel'] = 14;

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
  
  if($functionname=='zoomIn'){
  $_SESSION['zoomLevel']++; 
  }
  
  if($functionname=='zoomOut'){
  $_SESSION['zoomLevel']--;  
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
    var infowindow = new google.maps.InfoWindow();
    var speed = 1000;

    function init(){
     var dimens = getPreferredDimensions(); //retrieves the preferred dimension defined in the java server
     var width = dimens[0]; 
     var height = dimens[1];

      //set map dimensions in accordance to the host screen dimensions
      document.getElementById('map').style.width=width+'px';    
      document.getElementById('map').style.height=height+'px';    

      this.map = new google.maps.Map(document.getElementById('map'), {
        zoom: <? echo $_SESSION['zoomLevel']; ?>,
        disableDefaultUI: true,
        center: new google.maps.LatLng(10.304109603060656, 123.91754111328123),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
    }

    function updateMarker() {
      if(getMarkers()!=null){
        markers = getMarkers();

      for(i=0;i<markers.length;i++){
        markerData = markers[i].split(";");

        // alert("plateNo: "+markerData[0]+" status: "+markerData[1]+" lat: "+markerData[2]+" lng: "+markerData[3]);
        var marker = new google.maps.Marker({
                                      map:map,
                                      draggable:false,
                                      position: new google.maps.LatLng(markerData[2], markerData[3])
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {

            infowindow.setContent(
              "<div style='width:300px;height:80px'>"+
                "<div> plateNo: "+markerData[0]+"</div>"+
                "<div> status: "+markerData[1]+"</div>"+
              "</div>");
            infowindow.open(map, marker);
          }
        })(marker, i));

      }}
      window.setTimeout("updateMarker();", speed);  
    }

    window.setTimeout("updateMarker();", speed);


</script>
</head> 
<body onLoad="init();" marginheight="0px" marginwidth="0px">
  <div id="map" style="width: 500px; height: 400px;">
  </div>
</body>
</html>