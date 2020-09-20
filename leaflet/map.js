let mymap = L.map('mapid', {drawControl: false});
let osmUrl='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
let osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'; //for copyrights, bottom right
let osm = new L.TileLayer(osmUrl, {attribution: osmAttrib});
mymap.addLayer(osm);
mymap.setView([38.246242, 21.7350847], 16);

var editableLayers = new L.FeatureGroup();
mymap.addLayer(editableLayers);

var drawPluginOptions = {
  position: 'topright',
  draw: {
    polygon: {
      allowIntersection: true,
      drawError: {
        color: '#e1e100', 
        message: '<strong>Oh snap!<strong> you can\'t draw that!'
      },
      shapeOptions: {
        color: '#97009c'
      }
    },
    
    polyline: false,
    circle: false, // Turns off this drawing tool
    rectangle: false,
    marker: false,
    },
  edit: {
    featureGroup: editableLayers, //REQUIRED!!
    remove: false
  }
};


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

// Initialise the draw control and pass it the FeatureGroup of editable layers
var drawControl = new L.Control.Draw(drawPluginOptions);
mymap.addControl(drawControl);

var editableLayers = new L.FeatureGroup();
mymap.addLayer(editableLayers);

mymap.on('draw:created', function(e) {
  var type = e.layerType,
    layer = e.layer;

  //mallon axristo  
  if (type === 'marker') {
    layer.bindPopup('A popup!');
  }

  editableLayers.addLayer(layer);
  console.log(layer);
  console.log(layer._bounds);

  var polyLatLngs = layer._latlngs; 
  console.log(polyLatLngs);

  
  
  /*Prokeitai gia synartisi ray-casting algorithm, me skopo to crop twn dedomenwn
  apo to polygono, sto upload. en telei, den xrhsimopoieitai kapou. Yparxei mia
  antistoixh ylopoihsh sto actions/uploadaction.php */
  function isMarkerInsidePolygon(marker, poly) {
    var inside = false;
    var x = marker.getLatLng().lat, y = marker.getLatLng().lng; //shmeio test
    for (var ii=0;ii<poly.getLatLngs().length;ii++){ //vazei shmeio sto polyPoints 
        var polyPoints = poly.getLatLngs()[ii];
        for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
            var xi = polyPoints[i].lat, yi = polyPoints[i].lng;
            var xj = polyPoints[j].lat, yj = polyPoints[j].lng;

            var intersect = ((yi > y) != (yj > y))
                && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
            if (intersect) inside = !inside;
        }
    }

    return inside;
};
  einaiMesa = isMarkerInsidePolygon(marker, layer);
console.log(einaiMesa);

});

let cfg = { "radius": 40,
            "maxOpacity": 0.8,
            "scaleRadius": false,
            "useLocalExtrema": false,
            latField: 'latitude',
            lngField: 'longtitude',
            valueField: 'accuracy'};

let heatmapLayer = new HeatmapOverlay(cfg);

var analysisContainer = document.getElementById("analysisTable");

function ajaxCall(){
    console.log("this is from the click");

    var yearStart = document.getElementById("yearFrom").value;
    var yearEnd = document.getElementById("yearTo").value;

    var monthStart = document.getElementById("monthFrom").value;
    var monthEnd = document.getElementById("monthTo").value;

    var dayStart = document.getElementById("dayFrom").value;
    var dayEnd = document.getElementById("dayTo").value;

    var hourStart = document.getElementById("hourFrom").value;
    var hourEnd = document.getElementById("hourTo").value;

    var isStill = document.getElementById("stillValue");
    var isTilting = document.getElementById("tiltingValue");
    var isOnFoot = document.getElementById("onFootValue");
    var isInVehicle = document.getElementById("inVehicleValue");
    var isOnBicycle = document.getElementById("onBicycleValue");
    var isUnknown = document.getElementById("unknownValue");

    var moveArray = [isStill, isTilting, isOnFoot, isInVehicle, isOnBicycle, isUnknown];

    for (var i in moveArray){
      if(moveArray[i].checked == true){
        moveArray[i] = moveArray[i].value;
      }else{
        moveArray[i].value = "false";  
        moveArray[i] = moveArray[i].value;
      }
      console.log(moveArray[i]);
    }
    
    var ajax = new XMLHttpRequest();
    var method = "POST";
    var url = "leaflet/data.php"
    var asynchronous = true;
    var vdata;

    ajax.open(method, url, asynchronous);

    ajaxSendString =  '&yearStart=' + yearStart +'&yearEnd=' + yearEnd +
                      '&monthStart=' + monthStart + '&monthEnd=' + monthEnd +
                      '&dayStart=' + dayStart + '&dayEnd=' + dayEnd +
                      '&hourStart=' + hourStart + '&hourEnd=' + hourEnd +
                      '&isStill=' + moveArray[0] + '&isTilting=' + moveArray[1] +
                      '&isOnFoot=' + moveArray[2] + '&isInVehicle=' + moveArray[3] +
                      '&isOnBicycle=' + moveArray[4] + '&isUnknown=' + moveArray[5];

    // sending ajax request
    //xreiazotan header, kai allh syntaksi sto send
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(ajaxSendString);

    // receiving response from url
    ajax.onreadystatechange = function()
    {

        if (this.readyState == 4 && this.status == 200)
        {

            let json_data = JSON.parse(this.responseText);

            vdata = {
                max: 100,
                data: json_data.locations};

            if(json_data.sesUserID != "admin"){
              htmlgenerator(json_data.tableData);
            }

            heatmapLayer.setData(vdata);
            mymap.addLayer(heatmapLayer);
        }
    }
    var isStill = document.getElementById("stillValue").value="STILL";
    var isTilting = document.getElementById("tiltingValue").value="TILTING";
    var isOnFoot = document.getElementById("onFootValue").value="ON_FOOT";
    var isInVehicle = document.getElementById("inVehicleValue").value="IN_VEHICLE";
    var isOnBicycle = document.getElementById("onBicycleValue").value="ON_BICYCLE";
    var isUnknown = document.getElementById("unknownValue").value="UNKNOWN";
  };

function htmlgenerator(data){
  var analysisContainerData = document.getElementById("analysisTableData");
  if(!!analysisContainerData){
    analysisContainerData.remove();
  }
  if(data.length > 0){
    html = `<div id="analysisTableData" class="tables">
                <h3>Ανάλυση Στοιχείων</h3>
                <table style = "width:50%">
                  <tr>
                    <th>Είδος Δραστηριότητας</th>
                    <th>Ποσοστό</th>
                    <th>Πιο Ενεργή Ώρα</th>
                    <th>Πιο Ενεργή Μέρα</th>
                  </tr>
                  `;
    for(i=0; i<data.length; i++) {
      html +=`<tr>
               <td>`+data[i].type+`</td>
               <td>`+data[i].percent+`%</td>
               <td>`+data[i].MaxHour+`:00</td>
               <td>`+findDay(data[i].MaxDay)+`</td>
             </tr>
             `;
    }
    html += '</table> </div>';
    analysisContainer.insertAdjacentHTML('beforeend', html);
    console.log(html);
  }
};

function findDay(dayInt){
  var dayString;
  switch(dayInt){
    case 0:
      dayString = "Κυριακή";
    break;
    case 1:
      dayString = "Δευτέρα";
    break;
    case 2:
      dayString = "Τρίτη";
    break;
    case 3:
      dayString = "Τετάρτη";
    break;
    case 4:
      dayString = "Πέμπτη";
    break;
    case 5:
      dayString = "Παρασκευή";
    break;
    case 6:
      dayString = "Σάββατο";
    break;
    default:
      dayString = "";
  }
  return dayString;
};