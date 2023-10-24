

function initMap() {
  var latitud = 7.9076551; // Ejemplo de latitud
  var longitud = -72.5109501; // Ejemplo de longitud
    var latlng = new google.maps.LatLng(latitud, longitud);
    var geocoder = new google.maps.Geocoder();
  
    geocoder.geocode({ 'latLng': latlng }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          var direccion = results[0].formatted_address;
         
          console.log(direccion);
          document.getElementById('direccion').innerHTML = 'Dirección: ' + direccion;
        } else {
            console.log('no se encontro direccion');
        document.getElementById('direccion').innerHTML = 'No se encontró ninguna dirección.';
        }
      } else {
        console.log('error');
       document.getElementById('direccion').innerHTML = 'Error en la geocodificación: ' + status;
      }
    });
  }
  initMap();
  // Llamada a la función para convertir coordenadas
  
  //convertirCoordenadasADireccion(latitud, longitud);