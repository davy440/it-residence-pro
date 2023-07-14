//Handling the Property Map using the Google Maps JS API

var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyComHwJLpxWl91z0jqIvCOMuXYtaiv3UPI&callback=initMap';
script.async = true;

// Attach your callback function to the `window` object
window.initMap = function() {
    const mapContainer  =   document.getElementById('property-map');

    let mapProp = {
        center: new google.maps.LatLng(  itreMap.lat[0], itreMap.long[0] ),
        minZoom: 4,
        zoom: parseInt(itreMap.zoom[0]),
        maxZoom: 16,
        disableDefaultUI: !itreMap.controls[0]
    }

    let styles = mapProp.styles = []

    if ( itreMap.labels[0] !== "") {
        styles.push(
            {
                "featureType": "poi",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            }
        )
    }

    if ( itreMap.color[0] !== "default" ) {

        const mapHues = {
            "blue"   : "#5494d6",
            "yellow" : "#e8cc31",
            "brown"  : "#482d08",
            "green"  : "#36581b"
        };

        styles.push(
            {
                "stylers": [
                        { "hue": mapHues[itreMap.color[0]] }
                ]
            }
        )
    }

    if ( itreMap.color[0] == "mono" ) {
        styles.push(
            {
                "stylers": [
                    {"saturation": -100}
                ]
            }
        )
    }

    let map = new google.maps.Map(mapContainer, mapProp);

    let markerProps = {
        position: new google.maps.LatLng(  itreMap.lat[0], itreMap.long[0] ),
        map: map
    }

    let marker = new google.maps.Marker(markerProps)


    const headerMapContainer = document.getElementById('header-map')

    let headerMap = new google.maps.Map(headerMapContainer, mapProp);

    let headerMarkerProps = {
        position: new google.maps.LatLng(  itreMap.lat[0], itreMap.long[0] ),
        map: headerMap
    }
    let headerMarker = new google.maps.Marker(headerMarkerProps)

};

window.headerMap = function() {


}



// Append the 'script' element to 'head'
document.head.appendChild(script);
