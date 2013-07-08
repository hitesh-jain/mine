(function($) {
    $(document).ready(function() {
        var lat;
        var lng;
        var draw_circle;
		var path = location.href;
		var segmt = path.split("/");
		if(segmt[3] == 'hospital-locator' || segmt[3] == 'branch-locator')
		{
			navigator.geolocation.getCurrentPosition(GetLocation);
		}
        function GetLocation(location) {
            lat = location.coords.latitude;
            lng = location.coords.longitude;
        }
        $('#c09').change(function() {
            if($(this).is(':checked')) {
                //$('.google-store-locator-map').css('display', 'block');
            } else {
                //$('.google-store-locator-map').css('display', 'none');
            }
        });
        /* show my current location*/
        $('#c9').change(function() {
            if($(this).is(':checked')) {
                $('.currentdata').css('display', 'block');
                var latLng = new google.maps.LatLng(lat,lng);
                Drupal.GSL.currentMap.panTo(latLng);
                var marker = new google.maps.Marker({
                            map: Drupal.GSL.currentMap,
                            position: latLng
                });
            }else{
                $('.currentdata').css('display', 'none');
                showraduis(0,false);
            }
        });
        /* */
        $("#r8").change(function () {
            if ($("#r8").attr("checked")) {
                    showraduis(5,true);
                }
            });
        $("#r9").change(function () {
            if ($("#r9").attr("checked")) {
                showraduis(10,true);
                }
              });
        $("#r7").change(function () {
            if ($("#r7").attr("checked")) {
                    showraduis(0,false);
                }
              });
        function showraduis(km,flag){
                var kms = km*1000;
                var flag = flag;
                if(draw_circle != null){
                    draw_circle.setMap(null);
                }
                var latLng = new google.maps.LatLng(lat,lng);
                Drupal.GSL.currentMap.panTo(latLng);
                draw_circle = new google.maps.Circle({
                        map: Drupal.GSL.currentMap,
                        center:latLng,
                        radius:kms,
                        strokeColor:"#0000FF",
                        strokeOpacity:0.6,
                        strokeWeight:2,
                        fillColor:"#0000FF",
                        fillOpacity:0.2,
                        visible:flag,
						zoom:10
                    });
            }  
    });   
})(jQuery)