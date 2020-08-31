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

var analysisContainer = document.getElementById("analysisTable");

function ajaxCall(){
    console.log("this is from the click");

    var monthStart = document.getElementById("monthFrom").value;
    var monthEnd = document.getElementById("monthTo").value;
    var yearStart = document.getElementById("yearFrom").value;
    var yearEnd = document.getElementById("yearTo").value;
    //console.log("Month From is: " + monthStart);
    //console.log("Month To is: " + monthEnd);

    var ajax = new XMLHttpRequest();
    var method = "POST";
    var url = "leaflet/data.php"
    var asynchronous = true;
    var vdata;

    ajax.open(method, url, asynchronous);

    // sending ajax request
    //xreiazotan header, kai allh syntaksi sto send
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send('monthStart=' + monthStart + '&monthEnd=' + monthEnd + '&yearStart=' + yearStart +'&yearEnd=' + yearEnd);

    // receiving response from url
    ajax.onreadystatechange = function()
    {

        if (this.readyState == 4 && this.status == 200)
        {

            let json_data = JSON.parse(this.responseText);

            console.log(json_data.locations); //for debugging

            vdata = {
                max: 100,
                data: json_data.locations};

            console.log(vdata); //for debugging

            htmlgenerator(json_data.tableData);

            heatmapLayer.setData(vdata);
            mymap.addLayer(heatmapLayer);
        }
    }
};

function htmlgenerator(data){
  var analysisContainerData = document.getElementById("analysisTableData");
  if(!!analysisContainerData){
    analysisContainerData.remove();
  }
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
