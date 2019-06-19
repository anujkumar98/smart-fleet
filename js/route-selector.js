var busroute;
document.mainForm.onclick = function () {
    var routes = document.mainForm.route.value;
    if (routes == 'route1') {
        document.getElementById("bustable3").style.visibility="hidden";
        document.getElementById("bustable2").style.visibility="hidden";
        document.getElementById("bustable1").style.visibility="visible";
        if (busroute != null) {
            busroute.setMap(null);
        }
        var route = [
            { lat: 22.795987, lng: 86.189751 },
            { lat: 22.796575, lng: 86.193058 },
            { lat: 22.795508, lng: 86.195587 },
            { lat: 22.794941, lng: 86.197666 },
            { lat: 22.793112, lng: 86.19956 },
            { lat: 22.790443, lng: 86.200831 },
            { lat: 22.788429, lng: 86.200855 },
            { lat: 22.7896730, lng: 86.202036 },
            { lat: 22.790629, lng: 86.204423 },
            { lat: 22.792197, lng: 86.205699 },
            { lat: 22.792393, lng: 86.207518 },
            { lat: 22.794549, lng: 86.208416 }
        ];
        busroute = new google.maps.Polyline({
            path: route,
            geodesic: true,
            strokeColor: '#5a71c5',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

    }
    else if (routes == 'route2') {
        document.getElementById("bustable3").style.visibility="hidden";
        document.getElementById("bustable1").style.visibility="hidden";
        document.getElementById("bustable2").style.visibility="visible";

        if (busroute != null) {
            busroute.setMap(null);
        }
        var route2 = [
            { lat: 22.795987, lng: 86.189751 },
            { lat: 22.794368, lng: 86.189650},
            { lat: 22.792411, lng: 86.188702},
            { lat: 22.790946, lng: 86.187966},
            { lat: 22.789725, lng: 86.188879},
            { lat: 22.786740, lng: 86.195296},
            { lat: 22.785232, lng: 86.198533},
            { lat: 22.780277, lng: 86.194928},
            { lat: 22.778362, lng: 86.192562}
        ];
        busroute = new google.maps.Polyline({
            path: route2,
            geodesic: true,
            strokeColor: '#333333',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
    }
    else if (routes == 'route3') {
        document.getElementById("bustable2").style.visibility="hidden";
        document.getElementById("bustable1").style.visibility="hidden";
        document.getElementById("bustable3").style.visibility="visible";

        if (busroute != null) {
            busroute.setMap(null);
        }
        var route = [
            { lat: 22.795987, lng: 86.189751},
            { lat: 22.795237, lng: 86.191886 },
            { lat: 22.793856, lng: 86.194301 },
            { lat: 22.792031, lng: 86.195218 },
            { lat: 22.790161, lng: 86.197391 },
            { lat: 22.787356, lng: 86.200627 },
            { lat: 22.784818, lng: 86.200772 },
            { lat: 22.782681, lng: 86.200675 },
            { lat: 22.780366, lng: 86.201689 },
            { lat: 22.777858, lng: 86.202419 }

        ];
        busroute = new google.maps.Polyline({
            path: route,
            geodesic: true,
            strokeColor: '#AAA222',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
    }
    busroute.setMap(map);
}