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

function markerClick(event) {
this.getPopup().setLatLng(event.latlng).setContent("Coordinates: " + event.latlng.toString());}

//ajax call

var ajax = new XMLHttpRequest();
var method = "GET";
var url = "data.php";
var asynchronous = true;
var dataArray;
var vdata;

ajax.open(method, url, asynchronous);

ajax.send();

ajax.onreadystatechange = function(){

    if (this.readyState == 4 && this.status == 200){
        
        dataArray = JSON.parse(this.responseText);
        console.log(dataArray);

        vdata = {
            max: 20, data: dataArray
                    };
    


        //heatmap options
        let cfg = { "radius": 40,
                    "maxOpacity": 0.8,
                    "scaleRadius": false,
                    "useLocalExtrema": false,
                    latField: 'latitude',
                    lngField: 'longtitude',
                    valueField: 'accuracy'};
			

        let heatmapLayer = new HeatmapOverlay(cfg);
        heatmapLayer.setData(vdata);
        mymap.addLayer(heatmapLayer);

        }
    }