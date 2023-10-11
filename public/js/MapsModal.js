
// var maps =  document.getElementById("mapaModal");
// console.log(maps, " modal");

function initMapModal() {
    const lat = parseFloat(latitud);
    const long = parseFloat(longitud);
    console.log(lat, "modal", long);
    // Establecer el evento como no pasivo
    document.getElementById("mapaModal").addEventListener("click", function(event) {
        event.preventDefault();
    }, true);
  
    const myLatLng = {
        lat: lat,
        lng: long,
    };
    map = new google.maps.Map(document.getElementById('mapaModal'), {
        center: myLatLng,
        zoom: 20,
    });
  
    new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Gestión de Rutas",
    });
  }
  
  
 