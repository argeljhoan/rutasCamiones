
window.marcadores = [];
window.marcadoresIn= [];
window.iniMap;


async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker",
  );

  const lat = parseFloat(latitud);
  const long = parseFloat(longitud);
  const cod = codigo;
  console.log('codifgo',cod);
  // Establecer el evento como no pasivo


  const myLatLng = {
    lat: lat,
    lng: long,
  };


  const map = new Map(document.getElementById("mapaModal"), {
    center: myLatLng,
    zoom: 20,
    mapId: "4504f8b37365c3d0",
  });

  window.iniMap = map

  // A marker with a custom inline SVG.

  // A marker with a custom SVG glyph.

  // A marker using a Font Awesome icon for the glyph.
  const icon = document.createElement("div");

  icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;

  const faPin = new PinElement({
    glyph: icon,
    glyphColor: cod,
    background: "white",
    borderColor: cod,
  });
  const faMarker = new AdvancedMarkerElement({
    map,
    position: myLatLng,
    content: faPin.element,
    title: 'Latitud: '+ myLatLng.lat+' & Logintud: '+myLatLng.lng,
  });
  marcadoresIn.push(faMarker);
}


async function MarcadoresIndividual()
{

  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
  const lat = parseFloat(latitud);
  const long = parseFloat(longitud);
  const cod = codigo;
  console.log('codifgo',cod);
  // Establecer el evento como no pasivo

window.map = iniMap;


  const myLatLng = {
    lat: lat,
    lng: long,
  };

window.map.setCenter(myLatLng);


  for (const marcador of marcadoresIn) {
    marcador.setMap(null);
  }
  marcadoresIn = []

   const icon = document.createElement("div");

  icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;

  const faPin = new PinElement({
    glyph: icon,
    glyphColor: cod,
    background: "white",
    borderColor: cod,
  });
  const faMarker = new AdvancedMarkerElement({
    map,
    position: myLatLng,
    content: faPin.element,
    title: 'Latitud: '+ myLatLng.lat+' & Logintud: '+myLatLng.lng,
  });
  marcadoresIn.push(faMarker);

}


async function initMapGestion() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

  // Ubicación inicial del mapa
  const initialLatLng = {
    lat: 7.8939100,
    lng: -72.5078200,
  };

const mapGestion = new Map(document.getElementById("mapaactualizar"), {
    center: initialLatLng,
    zoom: 6,
    mapId: "4504f8b37365c3d0",
  });


  window.map = mapGestion;
 

  var count = 0;
    // El mapa está completamente cargado, ahora podemos crear marcadores
    for (const cod of codigo) {
      console.log(count+1);


  if(cod.lat != null && cod.long != null){
    const lat = parseFloat(cod.lat);
    const long = parseFloat(cod.long);
  
        const myLatLng = {
          lat: lat,
          lng: long,
        };
  
        const icon = document.createElement("div");
        icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;
  
        const faPin = new PinElement({
          glyph: icon,
          glyphColor: cod.codigo,
          background: "white",
          borderColor: cod.codigo,
        });
  
        const faMarker = new AdvancedMarkerElement({
          map,
          position: myLatLng,
          content: faPin.element,
          title: 'Latitud: '+ myLatLng.lat+' & Logintud: '+myLatLng.lng,
        });
         marcadores.push(faMarker);

  }

  

       
    }
  
}



async function Marcadores(){

console.log('gestionMapa');
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");


  for (const marcador of marcadores) {
    marcador.setMap(null);
  }
  marcadores = []

  for (const cod of codigo) {
    
    if(cod.lat != null && cod.long != null){

const lat = parseFloat(cod.lat);
const long = parseFloat(cod.long);

    const myLatLng = {
      lat: lat,
      lng: long,
    };

    const icon = document.createElement("div");
    icon.innerHTML = `<i class="bx bxs-truck" style="font-size:60px;"></i>`;

    const faPin = new PinElement({
      glyph: icon,
      glyphColor: cod.codigo,
      background: "white",
      borderColor: cod.codigo,
    });

    const faMarker = new AdvancedMarkerElement({
      map,
      position: myLatLng,
      content: faPin.element,
      title: 'Latitud: '+ myLatLng.lat+' & Logintud: '+myLatLng.lng,
    });

    marcadores.push(faMarker);

      }
  }
}