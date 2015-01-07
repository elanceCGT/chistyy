<script type="text/javascript">
	var map;
	var jsonArr = new Array();
	var markers = new Array();
	var infowindows = new Array();

	function initialize() {
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(35.709026, 139.731992),
			mapTypeControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.RIGHT_CENTER,
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.SATELLITE]
			},
			panControl: true,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			scaleControl: true, // fixed to BOTTOM_RIGHT
			streetViewControl: true,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			}
		}
		map = new google.maps.Map(document.getElementById("myMapDiv"), mapOptions);
		createMarker();
	}

	function createMarker() {
		geocoder = new google.maps.Geocoder();
		for (var i = 0; i < jsonArr.length; i++) {
			var infowindow = new google.maps.InfoWindow();
			var content = jsonArr[i].content;
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(jsonArr[i].position.lat, jsonArr[i].position.lng),
				map: map,
				title: jsonArr[i].title,
				icon: jsonArr[i].icon
			});
			markers.push(marker);
			google.maps.event.addListener(marker, 'click', (function(marker, content, infowindow) {
				return function() {
					infowindow.setContent(content);
					infowindow.open(map, marker);
				};
			})(marker, content, infowindow));
		}
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
</script>