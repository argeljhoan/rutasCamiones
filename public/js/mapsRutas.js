
window.marcadores = [];
window.map;
window.flightPath;


async function initMapGestion() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

  // Ubicación inicial del mapa


  codigo.reverse()

  var count = 0;
  // El mapa está completamente cargado, ahora podemos crear marcadores
  var tamaño = codigo.length

  console.log('tama', tamaño);


  const flightPlanCoordinates = []

  for (const cod of window.codigo) {
    console.log(cod);

    const lat = parseFloat(cod.lat);
    const long = parseFloat(cod.long);


    const initialLatLng = {
      lat: lat,
      lng: long,
    };

    flightPlanCoordinates.push({
      lat: lat,
      lng: long,
    });



    const icon = document.createElement("div");
    var color;

    if (count == 0) {




      const mapGestion = new Map(document.getElementById("mapaModal"), {
        center: initialLatLng,
        zoom: 12,
        mapId: "4504f8b37365c3d0",
      });

      window.map = mapGestion;
      icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;
      color = cod.codigo

    }

    else if (count == (tamaño - 1)) {

      console.log(tamaño - 1);
      console.log(cod.lat);


      icon.innerHTML = `<i class='bx bx-radio-circle-marked' style="font-size:40px;"></i>`;
      color = '#FF0000'


    } else {
      icon.innerHTML = `<i class='bx bx-radio-circle-marked' style="font-size:40px;"></i>`;
      color = '#0000FF'

    }
    if (cod.lat != null && cod.long != null) {
      const lat = parseFloat(cod.lat);
      const long = parseFloat(cod.long);

      const myLatLng = {
        lat: lat,
        lng: long,
      };



      const faPin = new PinElement({
        glyph: icon,
        glyphColor: color,
        background: "white",
        borderColor: color,
      });

      const faMarker = new AdvancedMarkerElement({
        map,
        position: myLatLng,
        content: faPin.element,
        title: 'Latitud: ' + myLatLng.lat + ' & Logintud: ' + myLatLng.lng,
      });
      window.marcadores.push(faMarker);

    }


    console.log('inicia', count);
    count++;
    console.log('aumenta', count);



  }
  flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
  });

  flightPath.setMap(map);

}


async function MarcadoresRutas() {

  console.log('gestionMapa');
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

  codigo.reverse()

  var count = 0
  var tamaño = codigo.length

  for (const marcador of marcadores) {
    marcador.setMap(null);

  }

  if (flightPath) {
    flightPath.setMap(null);
  }


  const flightPlanCoordinates = []
  window.marcadores = []

  for (const cod of window.codigo) {


    const lat = parseFloat(cod.lat);
    const long = parseFloat(cod.long);

    const icon = document.createElement("div");
    var color;


    flightPlanCoordinates.push({
      lat: lat,
      lng: long,
    });




    if (count == 0) {
      icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;
      color = cod.codigo
      console.log('truck');

    } else if (count == (tamaño - 1)) {

      icon.innerHTML = `<i class='bx bx-radio-circle-marked' style="font-size:40px;"></i>`;
      color = '#FF0000'
    }


    else {

      icon.innerHTML = `<i class='bx bx-radio-circle-marked' style="font-size:40px;"></i>`;
      color = '#0000FF'
      console.log('circle');
    }


    if (cod.lat != null && cod.long != null) {


      const myLatLng = {
        lat: lat,
        lng: long,
      };


      const faPin = new PinElement({
        glyph: icon,
        glyphColor: color,
        background: "white",
        borderColor: color,
      });

      const faMarker = new AdvancedMarkerElement({
        map,
        position: myLatLng,
        content: faPin.element,
        title: 'Latitud: ' + myLatLng.lat + ' & Logintud: ' + myLatLng.lng,
      });

      marcadores.push(faMarker);

    }

    count++;
  }

  flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
  });

  flightPath.setMap(map);

}