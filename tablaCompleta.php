<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id=urldecode($_GET['id']);
$archivo_csv = 'csv.csv'; // Asegúrate de que 'datos.csv' esté en la misma carpeta que tu plugin

// Abrir el archivo CSV
if (($handle = fopen($archivo_csv, 'r')) !== FALSE) {
    echo '<table border="1">'; // Comienza la tabla HTML

    // Recorrer cada línea del archivo
    while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
        if(preg_match_all("/".$id."/", $data[2],$c)){
            echo '<tr>'; // Comienza una nueva fila
            foreach ($data as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>'; // Cada celda de la fila
            }
            echo '</tr>'; // Cierra la fila
        }
    }

    echo '</table>'; // Cierra la tabla
    fclose($handle);
}


?>