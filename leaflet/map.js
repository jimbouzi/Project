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

//heatmap

/*let testData = {
    max: 8, data: [{lat: 38.246242, lng:21.735085, count:3},
    {lat: 38.323343, lng: 21.865082, count:2},
    {lat: 38.34381, lng: 21.57074, count:8},
    {lat: 38.108628, lng: 21.502075, count:7},
    {lat: 38.123034, lng: 21.917725, count:4}]};

//heatmap options
let cfg = { "radius": 40,
            "maxOpacity": 0.8,
            "scaleRadius": false,
            "useLocalExtrema": false,
            latField: 'lat',
            lngField: 'lng',
            valueField: 'count'};
			*/

let heatmapLayer = new HeatmapOverlay(cfg);
heatmapLayer.setData(testData);
mymap.addLayer(heatmapLayer);