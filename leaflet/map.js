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


//to problima arxizei edw !!!
// call ajax

/*var ajax = new XMLHttpRequest();
var method = "GET";
var url = "data.php"
var asynchronous = true;
var vdata;
var tdata;

ajax.open(method, url, asynchronous);
// sending ajax request
ajax.send();

// receiving response from url
ajax.onreadystatechange = function()
{

    if (this.readyState == 4 && this.status == 200)
    {
        //kai sigkekrimena edw
        tdata = JSON.parse(this.responseText);
        vdata = {
            max: 17000,
            min: 0,
            data: tdata };

        console.log(tdata); //for debugging
    }
}*/

var ajax = new XMLHttpRequest();
var method = "GET";
var url = "leaflet/data.php"
var asynchronous = true;
var vdata;
let tdata;

ajax.open(method, url, asynchronous);
// sending ajax request
ajax.send();

// receiving response from url
ajax.onreadystatechange = function()
{

    if (this.readyState == 4 && this.status == 200)
    {
        let json_data = JSON.parse(this.responseText);

        console.log(json_data); //for debugging


        vdata = {
            max: 17000,
            data: json_data};

        console.log(vdata); //for debugging

        let cfg = { "radius": 40,
                   "maxOpacity": 0.8,
                   "scaleRadius": false,
                   "useLocalExtrema": false,
                   latField: 'latitude',
                   lngField: 'longtitude',
                   valueField: 'accuracy'};

        console.log(vdata)
        let heatmapLayer = new HeatmapOverlay(cfg);
        heatmapLayer.setData(vdata);
        mymap.addLayer(heatmapLayer);

    }
}

//heatmap

/*let testData = {
    max: 8, data: [{lat: 38.246242, lng:21.735085, count:3},
    {lat: 38.323343, lng: 21.865082, count:2},
    {lat: 38.34381, lng: 21.57074, count:8},
    {lat: 38.108628, lng: 21.502075, count:7},
    {lat: 38.123034, lng: 21.917725, count:4}]};
*/
//heatmap options
