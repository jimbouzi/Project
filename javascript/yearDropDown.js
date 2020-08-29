function yearDropDown(elementID){ 

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

function getLastDropdownElement(elementID){
    var theSelect = document.getElementById(elementID);

    var lastValue = theSelect.options[theSelect.options.length - 1].value;

    theSelect.value = lastValue;
}

function getFirstDropdownElement(elementID){
    var theSelect = document.getElementById(elementID);

    var firstValue = theSelect.options[0].value;

    theSelect.value = firstValue;
}

yearDropDown('yearFrom');
yearDropDown('yearTo');