let mymap = L.map('mapid')
let osmUrl='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
let osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'; //for copyrights, bottom right
let osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
mymap.addLayer(osm);
mymap.setView([38.246242, 21.7350847], 16);

//adds draggable marker to map
let marker = L.marker ([38.246242, 21.7350847], {draggable: 'true'});
marker.addTo(mymap);
marker.bindPopup("<b>Patra</b>").openPopup();

//shows coordinates when marker is clicked
marker.on("click", markerClick);
//};

function markerClick(event) {
    this.getPopup().setLatLng(event.latlng).setContent("Coordinates: " + event.latlng.toString());
}

let cfg = { "radius": 40,
            "maxOpacity": 0.8,
            "scaleRadius": false,
            "useLocalExtrema": false,
            latField: 'latitude',
            lngField: 'longtitude',
            valueField: 'accuracy'};

let heatmapLayer = new HeatmapOverlay(cfg);

function ajaxCall(){
    console.log("this is from the click");

    var monthStart = document.getElementById("monthFrom").value;
    console.log("Month From is: " + monthStart);

    var ajax = new XMLHttpRequest();
    var method = "POST";
    var url = "leaflet/data.php"
    var asynchronous = true;
    var vdata;

    ajax.open(method, url, asynchronous);

    // sending ajax request
    //xreiazotan header, kai allh syntaksi sto send
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send('monthStart=' + monthStart);

    // receiving response from url
    ajax.onreadystatechange = function()
    {

        if (this.readyState == 4 && this.status == 200)
        {
            
            let json_data = JSON.parse(this.responseText);

            console.log(json_data); //for debugging

            vdata = {
                max: 100,
                data: json_data};

            console.log(vdata); //for debugging

            heatmapLayer.setData(vdata);
            mymap.addLayer(heatmapLayer);            
        }
    }
};

//!!! Pros to paron douleyei mono gia to monthFrom !!!