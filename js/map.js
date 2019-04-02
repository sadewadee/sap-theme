    /* ==============================================
    MAP -->
    =============================================== */
    
    var locations=[ ['<div class="infobox"><h3 class="title"><a href="#">OUR OFFICE</a></h3><span>DENPASAR, BALI, INDONESIA / 65</span><span>+62 555 666 77 88</span></div>',
    -8.666894,
    115.2382628,
    2]];
    var map=new google.maps.Map(document.getElementById('map'), {
        zoom: 11, scrollwheel: false, navigationControl: true, mapTypeControl: false, scaleControl: false, draggable: true, styles: [ {
            "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"on"}]}]
        }
        ], center: new google.maps.LatLng(-8.666894, 115.2382628), mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    );
    var infowindow=new google.maps.InfoWindow();
    var marker,
    i;
    for (i=0;
    i < locations.length;
    i++) {
        marker=new google.maps.Marker( {
            position: new google.maps.LatLng(locations[i][1], locations[i][2]), map: map, icon: 'images/apple-touch-icon.png'
        }
        );
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        }
        )(marker, i));
    }