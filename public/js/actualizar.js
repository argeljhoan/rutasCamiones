
            function actualizarNombreArchivo(input) {
                var nombreArchivo = input.files[0].name;
                document.getElementById("nombre-archivo").innerText = nombreArchivo;
                document.getElementById('foto').value = nombreArchivo;
            }
