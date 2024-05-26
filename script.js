var today = new Date().toISOString().split('T')[0];
document.getElementById("departure").setAttribute("min", today); 
document.getElementById("departure").addEventListener("change", function() {
    var departureDate = new Date(document.getElementById("departure").value);
    var maxArrivalDate = new Date(departureDate);
    maxArrivalDate.setDate(maxArrivalDate.getDate() + 14);
    var arrivalMinDate = departureDate.toISOString().split('T')[0];
    var arrivalMaxDate = maxArrivalDate.toISOString().split('T')[0];
    document.getElementById("arrival").setAttribute("min", arrivalMinDate);
    document.getElementById("arrival").setAttribute("max", arrivalMaxDate);
});
