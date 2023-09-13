// Obtener todas las filas de la tabla

function mostrarVentanaEmergente() {

    var filas = document.querySelectorAll('table tbody tr');
    // Agregar un controlador de eventos de clic a cada fila
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtener todas las celdas de la fila
            var celdas = this.getElementsByTagName('td');

            // Crear un objeto para almacenar la información de la fila
            var filaInfo = {
                id: celdas[0].textContent,
                nombre: celdas[1].textContent,
                identificacion: celdas[2].textContent,
                telefono: celdas[3].textContent,
                correo: celdas[4].textContent,
                rol: celdas[5].textContent,
                foto: celdas[7].getAttribute('data-foto')

            };

            // Mostrar la información en una ventana oculta (puedes adaptar esto a tu diseño)
            var ventanaOculta = document.getElementById('ventanaEliminar');
            var divPrincipal = document.getElementById('principal');

            ventanaOculta.innerHTML = `
        <div class='borderemer'>
            <div class='text-end'>
                <a class='btn-close' style="font-size:20px; color:black;margin-right: 10px;" id="cerrareliminar" style="color: red;"></a>
            </div>
            <div class="divContenedoremer">
                <div class="divInfoemer text-center">
                    <div class='infoemer'>
                        <p>Deseas Inhabilitar este Usuario: <strong>${filaInfo.nombre}</strong></p>
                    </div>
                    <div>  
                        <button class='btn btn-danger'>Confirmar</button>
                        <a id='cerrareliminar' class="btn btn-warning">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
            
            `;

            ventanaOculta.style.display = 'block';
            divPrincipal.style.display = 'block'; // Mostrar la ventana oculta
           
        });
    });

}
//http://localhost/gestionRutas/public/img/WhatsApp.jpeg
document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'cerrareliminar') {
        // Oculta el contenedor de detalles
        var userDetailsContainer = document.getElementById('principal');
        userDetailsContainer.style.display = 'none';
    }
});