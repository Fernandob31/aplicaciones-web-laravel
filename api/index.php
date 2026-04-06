<?php
// Ver en qué carpeta estamos parados
echo "Directorio actual: " . __DIR__ . "<br>";

// Listar carpetas un nivel arriba
echo "Contenido del nivel superior:<br>";
$files = scandir(__DIR__ . '/..');
foreach($files as $file) {
    echo "- $file<br>";
}