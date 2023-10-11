var miConductores = document.getElementById('miConductores').getAttribute('data-conductor');
var conductores = JSON.parse(miConductores);
console.log(conductores);


console.log(window.idcamion);


function Asignar() {



    var filas = document.querySelectorAll('table tbody tr');
    var ventanaOcultaAsignar = document.getElementById('infoAsignar');
    var divPrincipalAsignar = document.getElementById('asignar');


    // Limpiar el select antes de agregar nuevas opciones


    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            var celdas = this.getElementsByTagName('td');

            var filaInfoAsi = {
                id: celdas[0].textContent,
                matricula: celdas[1].textContent,

            };


            var estado = document.getElementById('cambiar');
            estado.style.display = 'none';


            window.idcamion = filaInfoAsi.id

            var formularioAsignar = document.getElementById('formasignar');
            var nuevaURL = formularioAsignar.getAttribute('data-action') ;
            
            var nuevaCadena = nuevaURL.slice(0, nuevaURL.lastIndexOf('/'));
             console.log( nuevaCadena + '/' + idcamion);
            formularioAsignar.action = nuevaCadena+ '/' + idcamion;


            console.log(window.idcamion);
            // Mostrar la información en la ventana oculta
            ventanaOcultaAsignar.innerHTML = `
      
            <div class='borderAsig'>
            <div class='text-end'>
                <a class='btn-close' style="font-size:20px; color:black;margin-right: 10px;" id="cerrarAsignar" style="color: red;"></a>
            </div>
            <div class="divContenedorAsig">
                <div class="divInfoAsig text-center">
                    <div class='infoAsig'>
                        <div class="divasig">
                            <strong>Matricula: </strong>
                            <span>${filaInfoAsi.matricula}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="text-md-start"><label for="user" class="col-md-3 col-form-label text-md-start">Conductor</label></strong>  
                            <div class="col-md-10">
                                <select class="form-select" name="user" id="user" required>
                                    <option value="">Seleccione un Conductor</option>
                                    <!-- Opciones de conductores se agregarán aquí -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>  
                        <div class="text-md-end"><button  class='btn btn-primary'>Asignar</buttonlass=></div>
                    </div>
                </div>
            </div>
        </div>
       
            `;

            // Agregar opciones de conductores al select
            var selectConductores = document.getElementById('user');


            conductores = conductores.filter(function (conductor) {
                return typeof conductor[0] != 'undefined';

            });


            conductores.forEach(function (conductor) {
                var option = document.createElement('option');
                option.value = conductor[0].id;
                option.textContent = conductor[0].name;
                selectConductores.appendChild(option);

            });

            ventanaOcultaAsignar.style.display = 'block';
            divPrincipalAsignar.style.display = 'block';



        });
    });
}


//http://localhost/gestionRutas/public/img/WhatsApp.jpeg
document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'cerrarAsignar') {
        // Oculta el contenedor de detalles
        var asignarEmergente = document.getElementById('asignar');
        asignarEmergente.style.display = 'none';
    }
});



