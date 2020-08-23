yearDropDown = function(elementID){

let startYear = 1950;
let endYear = new Date().getFullYear(); //prepei na pigainei mexri th simerini imerominia

for(y = startYear; y <= endYear; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // apo pou arxizei
        if (y == endYear) {
            optn.selected = true;
        } 
        
        document.getElementById(elementID).options.add(optn);
}
}

yearDropDown('yearFrom');
yearDropDown('yearTo');