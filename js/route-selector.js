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
            { lat: 22.78864, lng: 86.20719 },
            { lat: 22.797, lng: 86.20019 },
            { lat: 22.79854, lng: 86.1908 },
            { lat: 22.79849, lng: 86.19794 },
            { lat: 22.79356, lng: 86.20408 },
            { lat: 22.79158, lng: 86.20711 },
            { lat: 22.79194, lng: 86.21119 },
            { lat: 22.78964, lng: 86.21222 },
            { lat: 22.78811, lng: 86.21144 },
            { lat: 22.78814, lng: 86.20928 },
            { lat: 22.78814, lng: 86.20928 },
            { lat: 22.78811, lng: 86.21144 },
            { lat: 22.79194, lng: 86.21119 },
            { lat: 22.79158, lng: 86.20711 },
            { lat: 22.79356, lng: 86.20408 },
            { lat: 22.79658, lng: 86.19853 },
            { lat: 22.79717, lng: 86.19514 }
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
            { lat: 22.79849, lng: 86.19794},
            { lat: 22.79386, lng: 86.18961},
            { lat: 22.79004, lng: 86.18873},
            { lat: 22.79006, lng: 86.19403},
            { lat: 22.79242, lng: 86.19431},
            { lat: 22.79557, lng: 86.19021},
            { lat: 22.7942, lng: 86.18818},
            { lat: 22.79249, lng: 86.18779},
            { lat: 22.79249, lng: 86.18718},
            { lat: 22.79741, lng: 86.18535},
            { lat: 22.79658, lng: 86.19853},
            { lat: 22.79854, lng: 86.1908},
            { lat: 22.79597, lng: 86.120089},
            { lat: 22.79679, lng: 86.19118},
            { lat: 22.7894, lng: 86.19206 },
            { lat: 22.79528, lng: 86.19189 },
            { lat: 22.78741, lng: 86.18537 },
            { lat: 22.79055, lng: 86.18718 },
            { lat: 22.79249, lng: 86.18779},
            { lat: 22.7942, lng: 86.18818 },
            { lat: 22.79557, lng: 86.19021}
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
            { lat: 22.7977552, lng: 86.1874132 },
            { lat: 22.810022, lng: 86.198168 }];
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