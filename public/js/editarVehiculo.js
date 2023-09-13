
var tabla = document.querySelector('table');
var miVariable = document.getElementById('miVariable').getAttribute('data-camion');
var tipos = JSON.parse(miVariable);

tabla.addEventListener('click', function (event) {
    // Verificar si el objetivo del clic es una celda de información


    if (event.target.classList.contains('activar')) {
        var userDetailsContainer = document.getElementById('asignar');
        userDetailsContainer.style.display = 'none';
        var estado = document.getElementById('cambiar');
        estado.style.display = 'none';
        // Obtener la fila a la que pertenece la celda
        var fila = event.target.closest('tr');

        // Obtener todas las celdas de la fila
        var celdas = fila.getElementsByTagName('td');

        // Crear un objeto para almacenar la información de la fila
        var filaInfo = {
            matricula: celdas[1].textContent,
            tipo: celdas[2].textContent,
            marca: celdas[3].textContent,
            modelo: celdas[4].textContent,
            color: celdas[5].textContent,
            conductor: celdas[6].textContent,
            estado: celdas[6].textContent,
            foto: celdas[8].getAttribute('data-foto')
        };
    

        // Mostrar la información en una ventana oculta (puedes adaptar esto a tu diseño)
        var ventanaOculta = document.getElementById('editar');
        var cerrar = document.getElementById('edit');
       
        
       
        ventanaOculta.innerHTML = `
      
        <div class='text-start'>
        <h1>Editar Vehiculo</h1>
    </div>
    <div class="divContenedoredit overflow-auto custom-scroll" style="max-height:500px; overflow-x: auto;"> 
        <div class="divInfoedit mt-3">
            <div class="row mb-2">
                <label for="matricula" class="col-md-3 col-form-label text-md-start">Matricula</label>
                <div class="col-md-8">
                    <input id="matricula" type="text" class="form-control name" name="matricula" value="${filaInfo.matricula}" required autofocus>
                </div>
            </div>
    
            <div class="row mb-2">
                <label for="Marca" class="col-md-3 col-form-label text-md-start">Marca</label>
                <div class="col-md-8">
                    <input id="Marca" type="text" class="form-control name" name="Marca" value="${filaInfo.marca}" required >
                </div>
            </div>
    
            <div class="row mb-2">
                <label for="modelo" class="col-md-3 col-form-label text-md-start">Modelo</label>
                <div class="col-md-8">
                    <input id="modelo" type="text" class="form-control name" name="modelo" value="${filaInfo.modelo}" required >
                </div>
            </div>
    
            <div class="row mb-2">
                <label for="color" class="col-md-3 col-form-label text-md-start">Color</label>
                <div class="col-md-8">
                    <input id="color" type="text" class="form-control name" name="color" value="${filaInfo.color}" required >
                </div>
            </div>
    
            <div class="row mb-2">
                <label for="tipo" class="col-md-3 col-form-label text-md-start">Tipo</label>
                <div  class="col-md-8">
                    <select class="form-select" name="tipo" id="tipo">
                        <option value="">Seleccione un Tipo</option>
                        
                    </select>
                </div>
            </div>
          <div class="grupo">
            <div class="row mb-3">
                <label id="btnarchivo"  for="foto" class="col-md-3 col-form-label text-md-start">Foto Vehiculo</label>
                <div class="form-group col-md-8">
                    <label for="archivo" class="btn btn-success">
                        <span id="nombre-archivo">Seleccionar</span>
                        <input type="file" id="archivo" name="archivo" accept="image/*" style="display: none;" onchange="actualizarNombreArchivo(this)">
                        <input id="foto" type="hidden" name="foto">
                    </label>
                </div>
            </div>

            <div class="row mb-3">
            
            <div class="btn-submit form-group col-md-8">
              
                <button class="btn btn-primary">Actualizar</button>
                
            </div>
        </div>
        </div> 
            <div class="btnedit mt-2">
                <div class="">
                    <button class="btn btn-primary">Actualizar</button>
                </div>
            </div>
          
        </div>
    
        <div class="foto mt-3">
            <img class='imagen ' src="${filaInfo.foto}" alt="Descripción de la imagen">
        </div>
    </div>
        
       
       
    
        `;
        var selectipos = document.getElementById('tipo');
        tipos.forEach(function (tipo) {
            var option = document.createElement('option');
            option.value = tipo.id;
            option.textContent = tipo.name;
            selectipos.appendChild(option);
        });

        ventanaOculta.style.display = 'block'; // Mostrar la ventana oculta
        cerrar.style.display = 'block';
    }
});



document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'closeUserDetails') {
        // Oculta el contenedor de detalles
        var userDetailsContainer = document.getElementById('edit');
        userDetailsContainer.style.display = 'none';
    }
});