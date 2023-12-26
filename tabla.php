<?php
/**
 * Plugin Name: Tabla de csv
 * Plugin URI: http://infogonzalez.com
 * Description: Plugin mostrar tabla de csv
 * Version: 1.0
 * Author: Tomás González
 * Author URI: http://infogonzalez.com
 */

 function funcion_pagina_entera() {
 echo '
    <form id="miFormulario">
    <input type="text" id="campoTexto" placeholder="Escribe algo aquí...">
    <input type="submit" value="Enviar">
</form>

<div id="mostrar">
    <!-- Los resultados se mostrarán aquí -->
</div>';
echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
';
echo "<script>
document.getElementById('miFormulario').addEventListener('submit', function(event) {
    event.preventDefault();

    var valorInput = document.getElementById('campoTexto').value;
    document.getElementById('mostrar').innerText = valorInput;
    $(document).ready(function() {
        $.get('http://127.0.0.1/wordpress/wp-content/plugins/tabla-csv/tablaCompleta.php?id='+valorInput, function(data) {
            $('#mostrar').html(data);
        });
    });
});
</script>";
echo "<script>

</script>";

}
function mostrar_contenido_csv() {
    // Ruta al archivo CSV
    $archivo_csv = plugin_dir_path(__FILE__) . 'csv.csv'; // Asegúrate de que 'datos.csv' esté en la misma carpeta que tu plugin

    // Abrir el archivo CSV
    if (($handle = fopen($archivo_csv, 'r')) !== FALSE) {
        echo '<table border="1">'; // Comienza la tabla HTML

        // Recorrer cada línea del archivo
        while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
            echo '<tr>'; // Comienza una nueva fila
            foreach ($data as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>'; // Cada celda de la fila
            }
            echo '</tr>'; // Cierra la fila
        }

        echo '</table>'; // Cierra la tabla
        fclose($handle);
    }
}

// Utiliza un shortcode para que puedas insertar la tabla en cualquier página o publicación
add_shortcode('mostrar_csv', 'mostrar_contenido_csv');
add_shortcode( "mostrar_pagina", "funcion_pagina_entera" );
