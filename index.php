<?php

// Incluir la clase Escaner desde el directorio src
require 'src/Escaner.php';

// Inicializar variable para almacenar el resultado del procesamiento
$resultado = null;

// Verificar si la solicitud es de tipo POST (formulario enviado)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el texto ingresado por el usuario (vacío si no existe)
    $entrada  = $_POST['entrada'] ?? '';
    
    // Obtener la acción seleccionada por el usuario
    $accion   = $_POST['accion'] ?? '';
    
    // Crear una instancia de EscanerBasico con el texto de entrada
    $escaner  = new EscanerBasico($entrada, $entrada, $entrada);

    // Procesar la acción seleccionada usando match (switch de PHP 8+)
    $resultado = match($accion) {
        // Método de instancia: Elimina todas las etiquetas HTML del texto
        'limpiarEtiquetas' => $escaner->limpiarEtiquetas(),
        
        // Método de instancia: Extrae y limpia correos válidos del texto
        'limpiarCorreos'   => $escaner->limpiarCorreos(),
        
        // Método de instancia: Elimina etiquetas <script> del texto
        'limpiarScripts'   => $escaner->limpiarScripts(),
        
        // Método estático: Verifica si el texto contiene correos válidos
        'tieneCorreos'     => EscanerBasico::tieneCorreos($entrada) ? '✅ Contiene correos' : '❌ No contiene correos',
        
        // Método estático: Verifica si el texto contiene scripts potencialmente maliciosos
        'tieneScripts'     => EscanerBasico::tieneScripts($entrada) ? '✅ Contiene scripts' : '❌ No contiene scripts',
        
        // Método estático: Verifica si el texto contiene etiquetas HTML
        'tieneEtiquetas'   => EscanerBasico::tieneEtiquetas($entrada) ? '✅ Contiene etiquetas' : '❌ No contiene etiquetas',
        
        // Método estático: Sanitiza el texto eliminando caracteres peligrosos
        'sanitizar'        => EscanerBasico::sanitizar($entrada),
        
        // Valor por defecto si la acción no es reconocida
        default            => 'Acción no válida'
    };
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Configuración de viewport para responsividad en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaneo PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <!-- Formulario principal para enviar datos por POST -->
        <form method="POST">
            <label>Ingresa el texto a analizar:</label>
            <h5>Hecho por Jesús Alveo y Roniel Quintero</h5><br>
            <!-- Área de texto donde el usuario ingresa el contenido a analizar -->
            <!-- El valor se preserva si ya existe en $_POST (para mantener el texto después de procesar) -->
            <textarea name="entrada" placeholder="Pega aquí tu texto, HTML, correos o scripts..."><?= htmlspecialchars($_POST['entrada'] ?? '') ?></textarea>

            <!-- Mostrar el resultado solo si se ha procesado una acción -->
            <?php if ($resultado !== null): ?>
            <div class="resultado">
                <strong>Resultado:</strong><br><br>
                <!-- Mostrar el resultado del procesamiento (sanitizado para evitar XSS) -->
                <?= htmlspecialchars($resultado) ?>
            </div>
            <?php endif; ?>

            <!-- Contenedor principal de todos los botones y ejemplos -->
            <div class="botones">
                
                <!-- ===== EJEMPLO 1: LIMPIAR ETIQUETAS HTML ===== -->
                <div class= "Ejemplo1">
                    <h2>Ejemplo 1: Limpiar Etiquetas</h2>
                    <p>Este ejemplo muestra cómo eliminar etiquetas HTML de un texto utilizando el método <code>limpiarEtiquetas()</code>. Simplemente ingresa un texto con etiquetas HTML y haz clic en "Limpiar Etiquetas" para ver el resultado sin las etiquetas.</p>
                    <!-- Botón para ejecutar la acción de limpiar etiquetas (método de instancia) -->
                    <button name="accion" value="limpiarEtiquetas">Limpiar Etiquetas</button>
                    
                    <!-- Subsección: Métodos estáticos relacionados -->
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <!-- Botón para verificar si el texto contiene etiquetas HTML -->
                        <button name="accion" value="tieneEtiquetas">¿Tiene Etiquetas?</button>
                    </div>
                </div>

                <!-- ===== EJEMPLO 2: EXTRAER CORREOS ===== -->
                <div class= "Ejemplo2">
                    <h2>Ejemplo 2: Limpiar Correos</h2>
                    <p>En este ejemplo, puedes extraer correos electrónicos válidos de un texto utilizando el método <code>limpiarCorreos()</code>. Ingresa un texto que contenga correos electrónicos y haz clic en "Extraer Correos" para obtener una lista de los correos encontrados.</p>
                    <!-- Botón para ejecutar la acción de limpiar/extraer correos (método de instancia) -->
                    <button name="accion" value="limpiarCorreos">Extraer Correos</button>
                    
                    <!-- Subsección: Métodos estáticos relacionados -->
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <!-- Botón para verificar si el texto contiene correos válidos -->
                        <button name="accion" value="tieneCorreos">¿Tiene Correos?</button>
                    </div>
                </div>

                <!-- ===== EJEMPLO 3: ELIMINAR SCRIPTS MALICIOSOS ===== -->
                <div class= "Ejemplo3">
                    <h2>Ejemplo 3: Limpiar Scripts</h2>
                    <p>Este ejemplo demuestra cómo eliminar scripts maliciosos de un texto utilizando el método <code>limpiarScripts()  </code>. Ingresa un texto que contenga etiquetas <code>&lt;script&gt;</code> y haz clic en "Limpiar Scripts" para ver el resultado sin los scripts.</p>
                    <!-- Botón para ejecutar la acción de limpiar scripts (método de instancia) -->
                    <button name="accion" value="limpiarScripts">Limpiar Scripts</button>
                    
                    <!-- Subsección: Métodos estáticos relacionados -->
                    <div class = "Estaticos">
                        <h3>Método Estático</h3>
                        <!-- Botón para verificar si el texto contiene scripts potencialmente maliciosos -->
                        <button name="accion" value="tieneScripts">¿Tiene Scripts?</button>
                    </div>
                </div>
            
            </div>
            <!-- Botón general para sanitizar el texto (elimina caracteres peligrosos) -->
            <button name="accion" value="sanitizar">Sanitizar</button>
        </form>

    </main>
</body>
</html>