(function($) {
    $(document).ready(function() {
        var lat;
        var lng;
        var draw_circle;
        navigator.geolocation.getCurrentPosition(GetLocation);
        function GetLocation(location) {
            lat = location.coords.latitude;
            lng = location.coords.longitude;
        }
        $('#showmap').change(function() {
            if($(this).is(':checked')) {
                $('.google-store-locator-map').css('display', 'block');
            } else {
                $('.google-store-locator-map').css('display', 'none');
            }
        });
        $('#currentlocation').change(function() {
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
        $("#showfive").change(function () {
            if ($("#showfive").attr("checked")) {
                    showraduis(5,true);
                }
            });
        $("#showten").change(function () {
            if ($("#showten").attr("checked")) {
                showraduis(10,true);
                }
              });
        $("#showall").change(function () {
            if ($("#showall").attr("checked")) {
                    showraduis(0,false);
                }
              });
        function showraduis(km,flag){
                var kms = km*10000;
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
                        visible:flag
                    });
            }  
    });   
})(jQuery)