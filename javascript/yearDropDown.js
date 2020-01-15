let startYear = 1950;
let endYear = 2025;

for(y = startYear; y <= endYear; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2015 selected
        if (y == 2020) {
            optn.selected = true;
        }
        
        document.getElementById('year').options.add(optn);
}
