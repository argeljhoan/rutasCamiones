var tabla = document.querySelector('table');

tabla.addEventListener('click', function(event) {



    // Verificar si el objetivo del clic es una celda de información
    if (event.target.classList.contains('activar')) {
        var userDetailsContainer = document.getElementById('principal');
        userDetailsContainer.style.display = 'none';
        // Obtener la fila a la que pertenece la celda
        var fila = event.target.closest('tr');

        // Obtener todas las celdas de la fila
        var celdas = fila.getElementsByTagName('td');

        // Crear un objeto para almacenar la información de la fila
        var filaInfo = {
            nombre: celdas[1].textContent,
            identificacion: celdas[2].textContent,
            telefono: celdas[3].textContent,
            correo: celdas[4].textContent,
            rol: celdas[5].textContent,
            foto: celdas[7].getAttribute('data-foto')
        };

        // Mostrar la información en una ventana oculta (puedes adaptar esto a tu diseño)
        var ventanaOculta = document.getElementById('info');
        
        ventanaOculta.innerHTML = `
        <div class='border'>
        <div class='text-end'>
          <button class='btn-close'  id="closeinfo" style="color:'red'"></button>
        </div>
        
        <div class="divContenedor">
             <h1 class="name text-center">${filaInfo.nombre}</h1>
            <div class="divInfo text-center">
             <div class='info'>
              <p><strong>Identificacion:</strong> <span>${filaInfo.identificacion}</span></p>
              <p><strong>Telefono:</strong> <span>${filaInfo.telefono}</span></p>
              <p><strong>Correo:</strong> <span>${filaInfo.correo}</span></p>
              <p><strong>Rol:</strong> <span>${filaInfo.rol}</span></p>
             </div>
         

           <div class="foto">
           <img class='imagen ' src="${filaInfo.foto}" alt="Descripción de la imagen">
         
           </div>

           </div>
           </div>
        </div>
        </div>
        `;

        ventanaOculta.style.display = 'block'; // Mostrar la ventana oculta
    }
});


 
document.addEventListener('click', function(event) {
    if (event.target && event.target.id === 'closeinfo') {
        // Oculta el contenedor de detalles
        var userDetailsContainer = document.getElementById('info');
        userDetailsContainer.style.display = 'none';
    }
});