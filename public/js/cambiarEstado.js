var miEstados = document.getElementById('miEstados').getAttribute('data-estado');
var estados = JSON.parse(miEstados);

   function Cambiar() {

    var asignar = document.getElementById('asignar');
 
    var filas = document.querySelectorAll('table tbody tr');
    var ventanaOcultaestado = document.getElementById('infoestado');
    var divPrincipalestado = document.getElementById('cambiar');
    
    
    // Limpiar el select antes de agregar nuevas opciones
    

    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            var celdas = this.getElementsByTagName('td');

            var filaInfoEstado = {
                matricula: celdas[1].textContent,
                
            };

            // Mostrar la información en la ventana oculta
            ventanaOcultaestado.innerHTML = `
            <div class='borderAsig'>
            <div class='text-end'>
                <a class='btn-close' style="font-size:20px; color:black;margin-right: 10px;" id="cerrarEstado" style="color: red;"></a>
            </div>
            <div class="divContenedorAsig">
                <div class="divInfoAsig text-center">
                    <div class='infoAsig'>
                        <div class="divasig">
                            <strong>Matricula: </strong>
                            <span>${filaInfoEstado.matricula}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="text-md-start"><label for="estado" class="col-md-3 col-form-label text-md-start">Estado</label></strong>  
                            <div class="col-md-10">
                                <select class="form-select" name="estado" id="estado" required>
                                    <option value="">Seleccione un Estado</option>
                                    <!-- Opciones de conductores se agregarán aquí -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>  
                        <div class="text-md-end"><button class='btn btn-primary'>Cambiar</button></div>
                    </div>
                </div>
            </div>
        </div>
            `;

            // Agregar opciones de conductores al select
            var selectEstados = document.getElementById('estado');
            estados.forEach(function (estado) {
                var option = document.createElement('option');
                option.value = estado.id;
                option.textContent = estado.name;
                selectEstados.appendChild(option);
            });

            ventanaOcultaestado.style.display = 'block';
            divPrincipalestado.style.display = 'block'; 
            asignar.style.display = 'none';// Mostrar la ventana oculta
        });
    });
}



document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'cerrarEstado') {
        // Oculta el contenedor de detalles
        var estadosventana = document.getElementById('cambiar');
        estadosventana.style.display = 'none';
    }
});