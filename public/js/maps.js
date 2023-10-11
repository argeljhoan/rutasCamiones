



function initMap() {
  var map;
  var map1 =  document.getElementById("mapaactualizar");;
  var map2 = document.getElementById("mapaModal");
  var contMapas = [map1,map2]



  const lat = parseFloat(latitud);
  const long = parseFloat(longitud);
 
  // Establecer el evento como no pasivo
  

  const myLatLng = {
      lat: lat,
      lng: long,
  };
  map = new google.maps.Map(map1, {
      center: myLatLng,
      zoom: 20,
  });

  map = new google.maps.Map(map2, {
    center: myLatLng,
    zoom: 20,
});

map.addListener("scroll", function(event) {
  
  console.log('dentro del mapa ')
    // Tu lógica aquí en lugar de event.preventDefault()
});

  new google.maps.Marker({
      position: myLatLng,
      map,
      title: "Gestión de Rutas",
  });
}





//document.getElementById('mapaModal').appendChild(initMap());
